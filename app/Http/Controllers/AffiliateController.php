<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortitionRequest;
use App\Models\Number;
use App\Models\Sortition;
use App\Services\SortitionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AffiliateController extends Controller
{
    public function __construct(
        private SortitionService $sortition
    )
    {
    }

    public function index(Request $request)
    {
        $filter = $request->all();
        $perPage = $request->get('per_page', 5);
        $columns = ['id', 'title', 'slug'];

        $filter = [
            'user_id' => Auth::user()->id
        ];

        $sortitions = $this->sortition->getAll($filter, $perPage, $columns);

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
        $data['scheduled_at'] = Carbon::parse($data['scheduled_at'])->format('Y-m-d H:i:s');

        $image = $request->file('image');

        if ($image and !$image->isValid()) {
            return back()->withErrors(['image' => 'Arquivo inválido.']);
        }

        if ($image) {
            $image = $image->storeAs('images/' . date('Ymd'), $image->hashName(), [
                'disk' => 'public',
            ]);

            $image = Storage::disk('public')->url($image);

            $data['image'] = $image;
        }

        $sortition = $this->sortition->create($data);

        if ($this->sortition->code() != 201) {
            return back()->with('error', $this->sortition->message())->withInput();
        }

        for ($i = 1; $i <= $data['numbers_amount']; $i++):
            Number::create([
                'sortition_id' => $sortition->id,
                'number' => $i,
                'number_str' => str_pad($i, strlen((string) $data['numbers_amount']), '0', STR_PAD_LEFT),
            ]);
        endfor;

        return redirect()->route('affiliate.index')->with('success', 'Sorteio criado com suceso!');
    }

    public function edit(Request $request, ?int $id = null)
    {
        $sortition = $this->sortition->getById($id);

        return view('affiliate.edit', [
            'sortition' => $sortition,
        ]);
    }

    public function update(SortitionRequest $request, ?int $id = null)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['title']);
        $data['scheduled_at'] = Carbon::parse($data['scheduled_at'])->format('Y-m-d H:i:s');

        $image = $request->file('image');

        if ($image and !$image->isValid()) {
            return back()->withErrors(['image' => 'Arquivo inválido.']);
        }

        if ($image) {
            $image = $image->storeAs('images/' . date('Ymd'), $image->hashName(), [
                'disk' => 'public',
            ]);

            $image = Storage::disk('public')->url($image);

            $data['image'] = $image;
        }

        $this->sortition->update($id, $data);

        if ($this->sortition->code() != 200) {
            return back()->with('error', $this->sortition->message())->withInput();
        }

        return redirect()->route('affiliate.index')->with('success', 'Sorteio atualizado com suceso!');
    }
}
