<header class="bg-[#0a0a0a] w-full py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="hidden md:flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="text-4xl font-bold text-yellow-400">F12 <span class="font-normal text-white">Rifas</span></div>
            <!-- Logo -->

            <!-- Navigation -->
            <nav class="space-x-8 text-white font-medium">
                <a href="#home" class="hover:text-yellow-400">Início</a>
                <a href="#como-funciona" class="hover:text-yellow-400">Como Funciona</a>
                <a href="#porque-usar" class="hover:text-yellow-400">Por que Usar</a>
            </nav>
            <!-- Navigation -->

            <!-- Botão Conta -->
            @if (Auth::check())
                <a href="{{ route('painel') }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-2 px-4 rounded-lg transition">Minha
                    Conta</a>
            @else
                <a href="{{ route('login') }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-2 px-4 rounded-lg transition">Acessar</a>
            @endif
        </div>

        <!-- Mobile Header -->
        <div class="md:hidden py-4 relative">
            <!-- Logo -->
            <div class="text-6xl text-center font-bold text-yellow-400">F12 <span class="font-normal text-white">Rifas</span></div>
            <!-- Logo -->

            <div class="flex justify-center mt-8 gap-4">
                <button onclick="toggleMobileMenu()"
                    class="w-[115px] text-white border border-yellow-500 rounded-lg px-4 py-2">Menu</button>
                @if (Auth::check())
                    <a href="{{ route('painel') }}"
                        class="w-[115px] bg-yellow-500 hover:bg-yellow-600 text-black text-center font-semibold py-2 px-4 rounded-lg transition">Minha
                        Conta</a>
                @else
                    <a href="{{ route('login') }}"
                        class="w-[115px] bg-yellow-500 hover:bg-yellow-600 text-black text-center font-semibold py-2 px-4 rounded-lg transition">Acessar</a>
                @endif
            </div>
            <div id="mobileMenu"
                class="hidden fixed inset-0 bg-[#0a0a0a] z-40 flex flex-col items-center justify-center space-y-6 text-xl">
                <a href="#home" onclick="closeMobileMenu()" class="hover:text-yellow-400">Início</a>
                <a href="#como-funciona" onclick="closeMobileMenu()" class="hover:text-yellow-400">Como Funciona</a>
                <a href="#porque-usar" onclick="closeMobileMenu()" class="hover:text-yellow-400">Por que Usar</a>
                <button onclick="toggleMobileMenu()" class="mt-6 text-gray-400 text-sm underline">Fechar</button>
            </div>
        </div>
        <!-- Mobile Header -->
    </div>
</header>
