<header class="bg-[#0a0a0a] w-full border-b border-yellow-500 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Desktop -->
        <div class="hidden md:flex justify-between items-center h-16">
            <!-- Nome -->
            <div class="text-xl font-bold text-yellow-400">
                Olá, {{ Auth::user()->name }}
            </div>
            <!-- Nome -->

            <!-- Navegação -->
            <nav class="space-x-6 text-white font-medium">
                <a href="{{ route('affiliate.index') }}" class="hover:text-yellow-400">Sorteios</a>
                <a href="{{ route('affiliate.index') }}" class="hover:text-yellow-400">Vendas</a>
                <a href="{{ route('affiliate.index') }}" class="hover:text-yellow-400">Configurações</a>
            </nav>
            <!-- Navegação -->

            <!-- Botão sair -->
            <a href="{{ route('logout') }}"
                class="bg-yellow-600 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded-lg transition">Sair</a>
        </div>

        <!-- Mobile -->
        <div class="md:hidden py-4 relative">
            <!-- Logo -->
            <div class="w-full max-w-[350px] text-4xl font-bold text-yellow-400">
                <img class="w-full" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </div>
            <!-- Logo -->

            <div class="w-full max-w-[350px] flex justify-center mt-8 gap-4">
                <button onclick="toggleMobileMenu()"
                    class="w-full text-white border border-yellow-500 rounded-lg px-4 py-2">Menu</button>
                @if (Auth::check())
                    <a href="{{ route('painel') }}"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-black text-center font-semibold py-2 px-4 rounded-lg transition">Minha
                        Conta</a>
                @else
                    <a href="{{ route('login') }}"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-black text-center font-semibold py-2 px-4 rounded-lg transition">Acessar</a>
                @endif
            </div>

            <!-- Menu Mobile -->
            <div id="mobileMenu"
                class="hidden fixed inset-0 bg-[#0a0a0a] z-40 flex flex-col items-center justify-center space-y-6 text-xl">
                <a href="{{ route('affiliate.index') }}" onclick="closeMobileMenu()"
                    class="hover:text-yellow-400">Sorteios</a>
                <a href="{{ route('affiliate.index') }}" onclick="closeMobileMenu()"
                    class="hover:text-yellow-400">Vendas</a>
                <a href="{{ route('affiliate.index') }}" onclick="closeMobileMenu()"
                    class="hover:text-yellow-400">Configurações</a>
                <button onclick="closeMobileMenu()" class="mt-6 text-gray-400 text-sm underline">Fechar</button>
            </div>
        </div>
    </div>
</header>
