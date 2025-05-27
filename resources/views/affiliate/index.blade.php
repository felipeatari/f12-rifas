<x-layout.affiliate>
    <div class="w-full flex justify-center font-sans">
        <main class="w-full">
            <!-- Meus Sorteios -->
            <form id="meus-sorteios" class="mb-10">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-yellow-400">Meus Sorteios</h2>
                    <button
                        class="w-full sm:w-[150px] bg-yellow-400 text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-300 transition">
                        Cadastrar
                    </button>
                </div>

                <div class="overflow-x-auto bg-[#1a1a1a] rounded-lg border border-yellow-600">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-[#222] text-yellow-400 text-center">
                                <th class="p-3 border-b border-yellow-600">Título</th>
                                <th class="p-3 border-b border-yellow-600">Data do Sorteio</th>
                                <th class="p-3 border-b border-yellow-600">Status</th>
                                <th class="p-3 border-b border-yellow-600">Ações</th>
                            </tr>
                            <tr>
                                <th class="p-2 border-b border-yellow-600">
                                    <input type="text" name="title" class="w-full bg-black text-white border border-yellow-600 px-2 py-1 rounded">
                                </th>
                                <th class="p-2 border-b border-yellow-600">
                                    <input type="date" name="date" class="w-full bg-black text-white border border-yellow-600 px-2 py-1 rounded">
                                </th>
                                <th class="p-2 border-b border-yellow-600">
                                    <select name="status" class="w-full bg-black text-white border border-yellow-600 px-2 py-1 rounded">
                                        <option value=""></option>
                                        <option value="active">Ativo</option>
                                        <option value="closed">Encerrado</option>
                                    </select>
                                </th>
                                <th class="p-2 border-b border-yellow-600 text-center">
                                    <div class="flex flex-col sm:flex-row justify-center gap-2">
                                        <button class="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-300 transition">Filtrar</button>
                                        <a href="{{ route('affiliate') }}" class="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-300 transition">Limpar</a>
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($sortitions as $sortition)
                            <tr class="text-center border-t border-yellow-600">
                                <td class="p-3">{{ $sortition->title }}</td>
                                <td class="p-3">{{ (new DateTime($sortition->date))->format('d/m/Y') }}</td>
                                <td class="p-3 text-green-400 font-medium">{{ $sortition->status }}</td>
                                <td class="p-3">
                                    <div class="flex flex-col sm:flex-row justify-center gap-2">
                                        <button class="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-300 transition">Ver</button>
                                        <button class="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-300 transition">Divulgar</button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-3 py-4 text-center text-gray-400">
                                    Nenhum sorteio encontrado
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                        @if ($sortitions and $sortitions->hasPages())
                        <tfoot>
                            <tr class="border-t border-yellow-600">
                                <td colspan="1" class="px-3 py-3">
                                    <select name="per_page" class="bg-black text-white border border-yellow-600 px-2 py-1 rounded">
                                        <option value="5">5 por página</option>
                                        <option value="10">10 por página</option>
                                        <option value="50">50 por página</option>
                                    </select>
                                </td>
                                <td colspan="3" class="px-3 py-3 text-right">
                                    <div class="text-yellow-400">
                                        {{ $sortitions->links() }}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </form>
        </main>
    </div>
</x-layout.affiliate>
