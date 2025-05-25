<x-layout.account>
<div class="w-full flex flex-col items-center bg-gray-50 mt-10">
    <div class="w-[300px] flex flex-col items-center justify-between bg-white shadow py-5 px-4">
        <div class="w-full flex mb-2">
            <a href="{{ route('home') }}" class="underline">ir para o site</a>
        </div>

        {{-- <img class="w-[100px] mb-5" src="/assets/images/logo3.png" alt=""> --}}

        <form class="my-2" wire:submit.prevent="store">
            @if ($errors->any())
            <div class="w-full mb-2">
                @foreach ($errors->all() as $error)
                <span class="w-full flex flex-col bg-red-100 text-red-600 px-2 py-1 my-1 text-sm">{{ $error }}</span>
                @endforeach
            </div>
            @endif

            <div class="w-full flex my-1">
                <input wire:model="firstName" class="w-full mr-1 px-3 py-2 text-sm border rounded-md" placeholder="Nome" type="text">
                <input wire:model="lastName" class="w-full ml-1 px-3 py-2 text-sm border rounded-md" placeholder="Sobrenome" type="text">
            </div>

            <input wire:model="login" class="w-full px-3 py-2 my-1 text-sm border rounded-md" placeholder="WhatsApp" type="text">

            <input wire:model="password" class="w-full px-3 py-2 my-1 text-sm border rounded-md" placeholder="Senha" type="password">

            <input wire:model="confirmPassword" class="w-full px-3 py-2 my-1 text-sm border rounded-md" placeholder="Confirmar Senha" type="password">

            <button wire:click="store" class="w-full px-3 py-2 my-1 text-sm border rounded-md font-semibold bg-gray-700 hover:bg-gray-800 text-white">Cadastrar</button>
        </form>

        <span class="text-sm mt-6">Já tem uma conta? <a wire:navigate href="{{ route('login') }}" class="underline text-blue-900">Acesse aqui</a></span>
    </div>
</div>
</x-layout.account>
