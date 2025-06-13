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
        $numbers = is_array($request->numbers) ? $request->numbers : [];

        $unavailableNumbers = Number::query()
                        ->where('sortition_id', $sortitionId)
                        ->whereIn('number_str', $numbers)
                        ->where('status', '!=', 'available')
                        ->get();

        $numbers = [];

        if ($unavailableNumbers) {
            foreach ($unavailableNumbers as $value):
                $numbers[] = $value->number_str;
            endforeach;
        }

        if ($numbers) {
            if (count($numbers) === 1) {
                $message = 'Número indisponível: ' . $numbers[0];
            } else {
                $message = 'Números indisponivels: ' . implode(',', $numbers);
            }

            return redirect()->back()->with('error', $message)->withInput();
        }

        dd($request->all());
        return response()->json($request->all());
    }

    public function loadNumbers(Request $request)
    {
        // $data = [
        //     'numbersSelected' => ['0001', '0002', '0003'],
        //     'numbersSelectedCount' => 3,
        //     'priceUn' => 10,
        //     'priceTotal' => 30,
        //     'sortitionId' => 2
        // ];
        $data = [
            'numbersSelected' => [],
            'numbersSelectedCount' => 0,
            'priceUn' => 0,
            'priceTotal' => 0,
            'sortitionId' => 0
        ];

        $sortitionId = $request->get('sorteio');

        $datakey = 'sortition' . $sortitionId;

        $data = [$datakey => $data];

        return response()->json($data);
    }

    public function addNumbers(Request $request)
    {}
}
