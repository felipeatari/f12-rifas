<x-layout.account>
    <div class="w-full max-w-sm mx-auto bg-[#111111] text-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <a href="{{ route('home') }}" class="text-sm text-yellow-400 hover:underline">← Voltar ao site</a>
        </div>

        <h1 class="text-xl text-center font-semibold mb-8">Logar</h1>

        <form method="POST" action="{{ route('authenticate') }}">
            @csrf
            @if ($errors->any())
                <div class="bg-red-500 text-white px-4 py-2 mb-4 rounded">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <input type="text" name="whatsapp" placeholder="WhatsApp" class="w-full p-2 mb-3 text-white border border-[#363333] rounded" />
            <input type="password" name="password" placeholder="Senha" class="w-full p-2 mb-3 text-white border border-[#363333] rounded" />

            <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 rounded">Entrar</button>
        </form>

        <p class="mt-4 text-sm">Não tem uma conta? <a href="{{ route('register') }}" class="text-yellow-400 underline">Cadastre-se aqui</a></p>
    </div>
</x-layout.account>
