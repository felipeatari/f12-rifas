<?php

namespace App\Http\Controllers;

use App\Models\Number;
use App\Models\Sortition;
use App\Services\SortitionService;
use Illuminate\Http\Request;

class SortitionController extends Controller
{
    public function __construct(
        protected SortitionService $sortition
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

    public function checkout(Request $request)
    {
        $sortitionId = $request->input('sortition_id');
        $numbersExists = is_array($request->numbers) ? $request->numbers : [];

        if (! $sortitionId) {
            return redirect()->back()->with('error', 'Informe o ID do sorteio.')->withInput();
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

        return redirect()->back()->with('success', $request->name . ', pedido realizado com sucesso! <br> Verifique seu WhatsApp')->withInput();

        // return response()->json([
        //     'status' => 'success',
        //     'code' => 201,
        //      'data' => [
        //         'chave_aleatoria' => 'b7c9e8fa-21d4-4ef6-91a2-7f81c77e3c4e',
        //         'qr_code' => '00020126580014BR.GOV.BCB.PIX0136b7c9e8fa-21d4-4ef6-91a2-7f81c77e3c4e5204000053039865802BR5913Nome do Cliente6009SAO PAULO62070503***6304A1B2',
        //         'message' => 'Seus números foram reservados com sucesso! O pagamento deve ser realizado em até 10 minutos. Após esse prazo, os números serão liberados automaticamente.'
        //     ]
        // ]);
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

        $data = [$datakey => $data];

        return response()->json($data);
    }

    public function cleanNumbersSelected()
    {
        session()->forget('numbers_selected');

        return response()->json(['status' => 'success']);
    }
}
