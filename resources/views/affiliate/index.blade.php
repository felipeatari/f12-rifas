<x-layout.affiliate>
    <div class="w-full flex justify-center font-sans h-screen">
        <main class="w-full mt-10">
            <!-- Meus Sorteios -->
            <form id="meus-sorteios" class="mb-10">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                    <h2 class="text-xl font-bold text-white">Meus Sorteios</h2>
                    <button
                        class="w-full sm:w-[150px] bg-yellow-600 text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-700 transition">
                        Cadastrar
                    </button>
                </div>

                <div class="overflow-x-auto bg-[#0d0d0d] rounded-lg px-3 py-2">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-[#0d0d0d] text-yellow-600 text-center">
                                <th class="p-3">Título</th>
                                <th class="p-3">Ações</th>
                            </tr>
                            <tr>
                                <th class="p-2">
                                    <input type="text" name="title" class="w-full p-2 mb-3 text-white border border-[#363333] rounded">
                                </th>
                                <th class="p-3">
                                    <button class="min-w-[100px] bg-yellow-600 text-black font-bold px-3 py-1 my-1 rounded hover:bg-yellow-700 transition">Filtrar</button>
                                    <a href="{{ route('affiliate') }}">
                                        <button class="min-w-[100px] bg-yellow-600 text-black font-bold px-3 py-1 my-1 rounded hover:bg-yellow-700 transition">
                                            Limpar
                                        </button>
                                    </a>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($sortitions as $sortition)
                            <tr class="text-center">
                                <td class="p-3 text-sm">{{ $sortition->title }}</td>
                                <td class="p-3">
                                    <button class="min-w-[100px] bg-yellow-600 text-black font-bold px-3 py-1 my-1 rounded hover:bg-yellow-700 transition">Ver</button>
                                    <button class="min-w-[100px] bg-yellow-600 text-black font-bold px-3 py-1 my-1 rounded hover:bg-yellow-700 transition">Divulgar</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="px-3 py-4 text-center text-gray-400">
                                    Nenhum sorteio encontrado
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                        @if ($sortitions and $sortitions->hasPages())
                        <tfoot>
                            <tr>
                                <td class="px-3 py-3">
                                    <select name="per_page" class="bg-black text-white border border-yellow-600 px-2 py-1 rounded">
                                        <option value="5">5 por página</option>
                                        <option value="10">10 por página</option>
                                        <option value="50">50 por página</option>
                                    </select>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="flex justify-end text-yellow-600">
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
