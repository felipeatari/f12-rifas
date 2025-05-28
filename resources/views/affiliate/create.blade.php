<x-layout.affiliate>
    <div class="w-full h-screen flex flex-col items-center my-10">
        <h1 class="text-xl text-center font-semibold mb-10">Criar Campanha</h1>

        <form class="max-w-[600px]" method="POST" action="{{ route('affiliate.store') }}">
            @csrf
            <label class="text-sm" for="title">Título</label>
            <input
                name="title" id="title" type="text" value="{{ old('title') }}" placeholder="Título do sorteio"
                class="w-full p-2 mb-3 text-white border border-[#363333] rounded"
            >

            <div class="flex gap-2 my-4">
                <div class="w-1/2">
                    <label class="text-sm" for="price">Valor por número (R$)</label>
                    <input
                        name="price" id="price" type="number" step="0.01" value="{{ old('price') }}" placeholder="Ex: 10.00"
                        class="w-full p-2 mb-3 text-white border border-[#363333] rounded"
                    >
                </div>
                <div class="w-1/2">
                    <label class="text-sm" for="numbers">Quantidade de números</label>
                    <input name="numbers" id="numbers" type="number" value="{{ old('numbers') }}" placeholder="Ex: 1000"
                        class="w-full p-2 mb-3 text-white border border-[#363333] rounded">
                </div>
            </div>

            <div class="flex gap-2 my-4">
                <div class="w-1/2">
                    <label class="text-sm" for="date">Data do sorteio</label>
                    <input name="date" id="date" type="datetime-local" value="{{ old('date') }}" placeholder="00/00/0000 00:00:00"
                        class="w-full p-2 mb-3 text-white border border-[#363333] rounded">
                </div>
                <div class="w-1/2">
                    <label class="text-sm" for="image">Imagem <span class="text-xs">(opte por uma de alta qualidade)</span></label>
                    <input name="image" id="image" type="file"
                        class="w-full p-2 mb-3 text-white border border-[#363333] rounded bg-[#111111]">
                </div>
            </div>

            <label class="text-sm" for="description">Descrição</label>
            <textarea name="description" id="description" class="w-full h-[100px] p-2 mb-3 text-white border border-[#363333] rounded"
                placeholder="Descrição do sorteio">{{ old('description') }}</textarea>

            <div class="flex gap-2 mt-4">
                <a
                    href="{{ route('affiliate.index') }}"
                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-black text-center text-sm font-bold py-2 rounded-md transition duration-200"
                >
                    Cancelar
                </a>
                <button
                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-black text-sm font-bold py-2 rounded-md transition duration-200">
                    Cadastrar
                </button>
            </div>
        </form>
    </div>
</x-layout.affiliate>
