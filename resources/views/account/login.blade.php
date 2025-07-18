<x-layout.account>
    <div class="flex items-center justify-center px-4 pt-20">
        <div class="w-full max-w-sm bg-[#111111] text-white rounded-lg p-6 shadow-md">
            <a href="{{ route('home.index') }}" class="text-sm text-yellow-400 hover:underline mb-4 inline-block">← Voltar para o site</a>

            <h1 class="text-xl text-center font-semibold mt-4 mb-8">Logar</h1>

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
    </div>
</x-layout.account>
