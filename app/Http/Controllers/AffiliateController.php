<?php

namespace App\Http\Controllers;

use App\Services\SortitionService;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function __construct(
        private SortitionService $sortitionService
    )
    {
    }

    public function index(Request $request)
    {
        $filter = $request->all();
        $perPage = $request->get('per_page', 5);
        $columns = ['title', 'date', 'status'];

        $sortitions = $this->sortitionService->getAll($filter, $perPage, $columns);

        return view('affiliate.index', [
            'sortitions' => $sortitions['data'] ?? [],
        ]);
    }
}
