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

        // dd([
        //     'code' => $this->sortition->code(),
        //     'message' => $this->sortition->message(),
        // ]);

        if (!$sortition) return redirect()->route('home.index');

        return view('sortition.show', [
            'sortition' => $sortition,
        ]);
    }
}
