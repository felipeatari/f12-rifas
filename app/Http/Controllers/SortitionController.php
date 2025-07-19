<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Number;
use App\Models\Sale;
use App\Models\Sortition;
use App\Models\User;
use App\Services\EfiPixService;
use App\Services\SortitionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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

        if ($this->sortition->status() === 'error') return redirect()->route('home.index');

        return view('sortition.show', [
            'sortition' => $sortition,
        ]);
    }

    public function checkout(CheckoutRequest $request)
    {
        $data = $request->validated();
        $sortitionId = $request->input('sortition_id');
        $sortitionSlug = $request->input('sortition_slug');
        $sortitionPrice = $request->input('sortition_price');
        $numbersExists = is_array($request->numbers) ? $request->numbers : [];

        $cpf = onlyNumbers($data['cpf']);

        if (! $sortitionId) {
            return redirect()->back()->with('error', 'Informe o ID do sorteio.')->withInput();
        }

        if (! $sortitionSlug) {
            return redirect()->back()->with('error', 'Informe o Slug do sorteio.')->withInput();
        }

        if (! $sortitionPrice) {
            return redirect()->back()->with('error', 'O valor do sorteio deve ser informado.')->withInput();
        }

        if (! $numbersExists) {
            return redirect()->back()->with('error', 'Selecione pelo menos um número.')->withInput();
        }

        if (! validateCPF($cpf)) {
            return redirect()->back()->with('error', 'Selecione pelo menos um número.')->withInput();
        }

        $unavailableNumbersExists = Number::query()
            ->select(['id', 'number', 'number_str'])
            ->where('sortition_id', $sortitionId)
            ->whereIn('number_str', $numbersExists)
            ->where('status', '!=', 'available')
            ->get()
            ->toArray();

        $unavailableNumbers = []; // Salva números indisponíveis
        $mountSessionNumbers = []; // Salva os números disponíveis
        $saveCacheNumbers = [];

        if ($unavailableNumbersExists) {
            foreach ($unavailableNumbersExists as $unavailableNumber):
                $unavailableNumbers[] = $unavailableNumber['number_str'];
            endforeach;
        }

        foreach ($numbersExists as $value):
            if (in_array($value, $unavailableNumbers)) continue;

            $number = Number::query()
                ->select(['id', 'number', 'number_str'])
                ->where('sortition_id', $sortitionId)
                ->where('number_str', $value)
                ->where('status', 'available')
                ->first();

            $number->status = 'reserved';
            $number->save();

            $saveCacheNumbers[] = $number->toArray();
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

        $expired = now()->addMinutes(15)->timestamp;

        foreach ($saveCacheNumbers as $save):
            $keyNumber = 'number:' . $save['id'] . $sortitionId;

            Redis::set($keyNumber, json_encode([
                'number_id' => $save['id'],
                'sortition_id' => $sortitionId,
                'expired' => $expired,
            ]));
        endforeach;

        session()->forget('numbers_selected');

        $numbersQtd = count($numbersExists);
        $priceUn = $sortitionPrice;
        $priceTotal = $sortitionPrice;

        if ($numbersQtd > 1) {
            $priceTotal *= $numbersQtd;
        }

        $original = (string) number_format($priceTotal, 2, '.');

        $body = [
            'calendario' => [
                'expiracao' => 900 // Expira em 15 min
            ],
            'devedor' => [
                'cpf' => $cpf,
                'nome' => $data['name']
            ],
            'valor' => [
                'original' => $original
            ],
            'chave' => config('efi.pix_key'), // Chave Pix
            'solicitacaoPagador' => 'Cobrança da compra de números.',
        ];

        $createBilling = $this->efiPixService->createBilling($body);

        if ($this->efiPixService->status() === 'error') {
            return redirect()->back()->with('error', 'Falha ao gerar cobrança via Pix. Tente novamente.')->withInput();
        }

        $client = User::firstOrCreate(
            ['whatsapp' => $data['whatsapp']], // condição de busca
            [
                'name' => $data['name'],
                'type' => 'client',
                'password' => null,
            ]
        );

        $sale = Sale::create([
            'user_id' => $client->id,
            'sortition_id' => $sortitionId,
            'numbers' => json_encode($mountSessionNumbers),
            'total_numbers' => count($mountSessionNumbers),
            'unit_price' => $priceUn,
            'total_price' => $priceTotal,
            'status' => 'paid'
        ]);

        $key = 'sale:' . $sale->id;

        $payload = [
            'pix_copia_e_cola' => $createBilling['pixCopiaECola'],
            'value_total' => $priceTotal,
            'sortition_id' => $sortitionId,
            'expired_at' => 900,
            'body' => $body
        ];

        Redis::setex($key, 900, json_encode($payload));

        return redirect()->route('sortition.payment', ['sale_id' => $sale->id]);
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

    public function payment($saleId)
    {
        $key = 'sale:' . $saleId;
        $getSessionPix = Redis::get($key);
        $sessionPix = $getSessionPix ? json_decode($getSessionPix, true) : [];

        if (!$sessionPix) {
            return redirect()->route('sortition.show', ['slug' => $slug])->with('error', 'QR Code Pix não existe ou expirou.')->withInput();
        }

        $sortitionId = $sessionPix['sortition_id'];
        $valueTotal = $sessionPix['value_total'];
        $pixCopiaECola = $sessionPix['pix_copia_e_cola'];

        return view('sortition/payment', [
            'sortitionId' => $sortitionId,
            'valueTotal' => $valueTotal,
            'pixCopiaECola' => $pixCopiaECola,
        ]);
    }
}
