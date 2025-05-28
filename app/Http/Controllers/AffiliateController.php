<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortitionRequest;
use App\Models\Sortition;
use App\Services\SortitionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $columns = ['id', 'title'];

        $sortitions = $this->sortitionService->getAll($filter, $perPage, $columns);

        return view('affiliate.index', [
            'sortitions' => $sortitions ?? [],
        ]);
    }

    public function create()
    {
        return view('affiliate.create');
    }

    public function store(SortitionRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($data['title']);
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d H:i:s');

        $this->sortitionService->create($data);

        if ($this->sortitionService->code() != 201) {
            return redirect()->back()->with('error', $this->sortitionService->message())->withInput();
        }

        return redirect()->route('affiliate.index')->with('success', 'Sorteio criado com suceso!');
    }

    public function edit(Request $request, ?int $id = null)
    {
        $sortition = $this->sortitionService->getById($id);

        return view('affiliate.edit', [
            'sortition' => $sortition,
        ]);
    }

    public function update(SortitionRequest $request, ?int $id = null)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['title']);
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d H:i:s');

        $this->sortitionService->update($id, $data);

        if ($this->sortitionService->code() != 200) {
            return redirect()->back()->with('error', $this->sortitionService->message())->withInput();
        }

        return redirect()->route('affiliate.index')->with('success', 'Sorteio atualizado com suceso!');
    }
}
