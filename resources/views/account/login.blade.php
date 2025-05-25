<x-layout.account>
<div class="w-full h-screen flex flex-col items-center max-[500px]:mt-2 max-[500px]:mb-10 bg-gray-50 max-[450px]:mx-2 mt-10">
    <div class="w-[300px] max-[450px]:w-full flex flex-col items-center justify-between bg-white shadow py-5 px-4">
        <div class="w-full flex mb-2">
            <a href="{{ route('home') }}" class="underline">ir para o site</a>
        </div>

        {{-- <img class="w-[100px] mb-5" src="/assets/images/logo3.png" alt=""> --}}

        <form class="my-2" method="POST" action="{{ route('authenticate') }}">
            @csrf
            @if ($errors->any())
            <div class="w-full flex flex-col border border-red-200 bg-red-100 text-red-600 px-2 py-1 my-5">
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
            @endforeach
            </div>
            @endif

            <input type="text" name="whatsapp" class="w-full px-3 py-2 my-1 text-sm border rounded-md" placeholder="WhatsApp">

            <input type="password" name="password" class="w-full px-3 py-2 my-2 text-sm border rounded-md" placeholder="Senha">

            <button class="w-full px-3 py-2 mt-2 text-sm border rounded-md font-semibold bg-gray-700 hover:bg-gray-800 text-white">Login</button>
        </form>

        <span class="text-sm mt-6">Não tem uma conta? <a wire:navigate href="{{ route('register') }}" class="underline text-blue-900">Cadastre-se aqui</a></span>
    </div>
</div>
</x-layout.account>
