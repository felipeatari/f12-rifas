<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Number;
use App\Models\Sortition;
use App\Services\EfiPixService;
use App\Services\SortitionService;
use Illuminate\Http\Request;

class SortitionController extends Controller
{
    public function __construct(
        protected EfiPixService $efiPixService,
        protected SortitionService $sortition,
    )
    {
    }

    public function show(Request $request, string $slug)
    {
        $sortition = $this->sortition->getOne(['slug' => $slug]);

        if (!$sortition) return redirect()->route('home.index');

        return view('sortition.show', [
            'sortition' => $sortition,
        ]);
    }

    public function checkout(CheckoutRequest $request)
    {
        $data = $request->validated();
        $sortitionId = $request->input('sortition_id');
        $sortitionPrice = $request->input('sortition_price');
        $numbersExists = is_array($request->numbers) ? $request->numbers : [];

        if (! $sortitionId) {
            return redirect()->back()->with('error', 'Informe o ID do sorteio.')->withInput();
        }

        if (! $sortitionPrice) {
            return redirect()->back()->with('error', 'O valor do sorteio deve ser informado.')->withInput();
        }

        if (! $numbersExists) {
            return redirect()->back()->with('error', 'Selecione pelo menos um número.')->withInput();
        }

        $unavailableNumbersExists = Number::query()
            ->select(['id', 'number', 'number_str'])
            ->where('sortition_id', $sortitionId)
            ->whereIn('number_str', $numbersExists)
            ->where('status', '!=', 'available')
            ->get()
            ->toArray();

        $unavailableNumbers = [];

        if ($unavailableNumbersExists) {
            foreach ($unavailableNumbersExists as $unavailableNumber):
                $unavailableNumbers[] = $unavailableNumber['number_str'];
            endforeach;
        }

        $mountSessionNumbers = [];
        foreach ($numbersExists as $value):
            if (in_array($value, $unavailableNumbers)) continue;

            $mountSessionNumbers[] = $value;
        endforeach;

        session()->put('numbers_selected', $mountSessionNumbers);

        if ($unavailableNumbers) {
            if (count($unavailableNumbers) === 1) {
                $message = 'Número indisponível: ' . $unavailableNumbers[0];
            } else {
                $message = 'Números indisponivels: ' . implode(',', $unavailableNumbers);
            }

            $message .= "<br>Você pode continuar selecionando ou clicar em 'checkout' para continuar.";

            return redirect()->back()->with('warning', $message)->withInput();
        }

        session()->forget('numbers_selected');

        $numbersQtd = count($numbersExists);
        $priceUn = $sortitionPrice;
        $priceTotal = $sortitionPrice;

        if ($numbersQtd > 1) {
            $priceTotal *= $numbersQtd;
        }

        $body = [
            'calendario' => [
                'expiracao' => 600 // Expira em 10 min
            ],
            'devedor' => [
                'cpf' => $data['cpf'],
                'nome' => $data['name']
            ],
            'valor' => [
                'original' => $priceTotal
            ],
            'chave' => config('efi.pix_key'), // Chave Pix
            'solicitacaoPagador' => 'Cobrança da compra de números.',
        ];

        // dd($body);

        // $createBilling = $this->efiPixService->createBilling($body);

        return redirect()->back()->with('success', $request->name . ', Números reservados com sucesso! <br> Verifique seu WhatsApp')->withInput();
        // return redirect()->back()->with('success', $request->name . ', pedido realizado com sucesso! <br> Verifique seu WhatsApp')->withInput();
    }

    public function loadNumbers(Request $request)
    {
        $data = session()->get('numbers_selected') ?? [ 'numbers_selected' => [] ];

        $sortitionId = $request->get('sorteio');

        if (! $sortitionId) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Informe o ID do sorteio.',
            ]);
        }

        $datakey = 'sortition' . $sortitionId;

        $data = [ $datakey => $data ];

        return response()->json($data);
    }

    public function cleanNumbersSelected()
    {
        session()->forget('numbers_selected');

        return response()->json(['status' => 'success']);
    }

    public function index(Request $request)
    {
        return $this->sortition->getAll();
    }

    public function showId($id)
    {
        $sortition = $this->sortition->getById($id);

        if ($this->sortition->status() === 'error') {
            return response()->json([
                'code' => $sortition->code(),
                'message' => $sortition->message(),
            ]);
        }

        return response()->json($sortition);
    }
}
