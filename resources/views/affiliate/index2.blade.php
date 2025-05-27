<x-layout.affiliate>
    <div class="w-full flex justify-center min-h-screen font-sans">
        <main class="p-6">
            {{-- <div class="bg-white shadow p-4 mb-6 rounded">
                <h1 class="text-2xl font-semibold">Bem-vindo, Vendedor</h1>
            </div> --}}

            <!-- Meus Sorteios -->
            <form id="meus-sorteios" class="mb-8">
                <div class="flex justify-between mb-4">
                    <h2 class="text-xl font-bold">Meus Sorteios</h2>
                    <button
                        class="w-[100px] bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Cadastrar</button>
                </div>
                <table class="text-left border border-gray-200 bg-white rounded">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 border-b text-center">Título</th>
                            <th class="p-3 border-b text-center">Data do Sorteio</th>
                            <th class="p-3 border-b text-center">Status</th>
                            <th class="p-3 border-b text-center">Ações</th>
                        </tr>
                        <tr>
                            <th class="p-3 border-b text-center">
                                <input type="text" name="title" class="w-full border px-2 py-1 rounded">
                            </th>
                            <th class="p-3 border-b text-center">
                                <input type="date" name="date" class="w-full border px-2 py-1 rounded">
                            </th>
                            <th class="p-3 border-b text-center">
                                <select name="status" class="w-full border px-2 py-1 rounded">
                                    <option value="">Selecionar</option>
                                    <option value="active">Ativo</option>
                                    <option value="closed">Encerrado</option>
                                </select>
                            </th>
                            <th class="p-3 border-b text-center flex">
                                <button class="w-[100px] bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 mr-1">Filtrar</button>
                                <a href="{{ route('affiliate') }}" class="w-[100px] bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 font-normal">Limpar</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sortitions as $sortition)
                        <tr>
                            <td class="p-3 border-b text-center">
                                {{ $sortition->title }}
                            </td>
                            <td class="p-3 border-b text-center">
                                {{ (new DateTime($sortition->date))->format('d/m/Y') }}
                            </td>
                            <td class="p-3 border-b text-center text-green-600 font-medium">
                                {{ $sortition->status }}
                            </td>
                            <td class="p-3 border-b flex">
                                <button
                                    class="w-[100px] bg-blue-500 text-white px-3 py-1 mr-1 rounded hover:bg-blue-600">Ver</button>
                                <button
                                    class="w-[100px] bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Divulgar</button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-2 text-center">
                                    Nenhum sorteio encontrado
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($sortitions and $sortitions->hasPages())
                    <tfoot>
                        <tr>
                            <td colspan="1" class="px-3 py-2">
                                <select name="per_page" class="w-[150px] border px-2 py-1 rounded-md">
                                    <option value="5">5 por página</option>
                                    <option value="10">10 por página</option>
                                    <option value="50">50 por página</option>
                                </select>
                            </td>
                            <td colspan="3" class="px-3 py-2">
                                {{ $sortitions->links() }}
                            </td>
                            <td class="px-3 py-2">
                                {{ $sortitions->links() }}
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>

                {{-- <div class="w-full h-5 mt-4 flex items-center justify-between">
                    <select name="perPage" class="w-[150px] border px-2 py-1 rounded-md">
                        <option value="5">5 por página</option>
                        <option value="10">10 por página</option>
                        <option value="50">50 por página</option>
                    </select>

                    @if ($sortitions and $sortitions->hasPages())
                    <span>Página {{ $sortitions->currentPage() }}</span>

                    <div>{{ $sortitions->links() }}</div>
                    @endif
                </div> --}}

                <!-- Resumo de Vendas e Faturamento -->
                {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                    <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-bold mb-2">Total de Vendas</h3>
                    <p class="text-gray-700 text-xl">128 cotas vendidas</p>
                    </div>
                    <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-bold mb-2">Faturamento</h3>
                    <p class="text-gray-700 text-xl">R$ 6.400,00</p>
                    </div>
                </div> --}}
            </form>

            <!-- Configurações -->
            {{-- <section id="configuracoes">
            <h2 class="text-xl font-bold mb-4">Configurações</h2>
            <form class="bg-white p-6 rounded shadow max-w-lg">
                <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <input type="text" class="w-full border rounded p-2" placeholder="Seu nome completo">
                </div>
                <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" class="w-full border rounded p-2" placeholder="seu@email.com">
                </div>
                <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Chave PIX</label>
                <input type="text" class="w-full border rounded p-2" placeholder="Digite sua chave PIX">
                </div>
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Salvar Alterações</button>
            </form>
            </section> --}}
        </main>
    </div>
</x-layout.affiliate>
