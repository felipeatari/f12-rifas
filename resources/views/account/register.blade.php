<x-layout.account>
    <div class="flex items-center justify-center px-4">
        <div class="w-full max-w-sm bg-[#111111] text-white rounded-lg p-6 shadow-md">
            <a href="{{ route('home.index') }}" class="text-sm text-yellow-400 hover:underline mb-4 inline-block">← Voltar para o site</a>

            <h1 class="text-xl text-center font-semibold mt-4 mb-8">Criar sua conta</h1>

            <form method="POST" action="">
                @csrf
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-300 text-red-700 text-sm p-2 mb-4 rounded">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="flex gap-2 mb-3">
                    <input name="firstName" type="text" class="w-1/2  p-2 mb-3 text-white border border-[#363333] rounded" placeholder="Nome">
                    <input name="lastName" type="text" class="w-1/2  p-2 mb-3 text-white border border-[#363333] rounded" placeholder="Sobrenome">
                </div>

                <input name="login" type="text" class="w-full p-2 mb-3 text-white border border-[#363333] rounded" placeholder="WhatsApp">

                <input name="password" type="password" class="w-full p-2 mb-3 text-white border border-[#363333] rounded" placeholder="Senha">

                <input name="confirmPassword" type="password" class="w-full p-2 mb-3 text-white border border-[#363333] rounded" placeholder="Confirmar Senha">

                <button wire:click="store" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black text-sm font-semibold py-2 rounded-md transition duration-200">
                    Cadastrar
                </button>
            </form>

            <p class="text-sm text-center mt-6">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="text-yellow-400 underline">Acesse aqui</a>
            </p>
        </div>
    </div>
</x-layout.account>
