<?php

namespace App\Http\Controllers;

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

        if (!$sortition) return redirect()->route('home');

        return view('sortition.show', [
            'sortition' => $sortition,
        ]);
    }
}
