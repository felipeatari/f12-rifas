<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon.ico') }}">
    <title>Afiliado</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        function closeMobileMenu() {
            document.getElementById('mobileMenu').classList.add('hidden');
        }
    </script>
</head>

<body class="bg-[#111111] text-white scroll-smooth">
    <!-- Header -->
    <header class="bg-[#0a0a0a] w-full border-b border-yellow-500 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Desktop -->
            <div class="hidden md:flex justify-between items-center h-16">
                <!-- Nome -->
                <div class="text-xl font-bold text-yellow-400">
                    Olá, {{ Auth::user()->name }}
                </div>

                <!-- Navegação -->
                <nav class="space-x-6 text-white font-medium">
                    <a href="{{ route('affiliate.index') }}" class="hover:text-yellow-400">Sorteios</a>
                    <a href="{{ route('affiliate.index') }}" class="hover:text-yellow-400">Vendas</a>
                    <a href="{{ route('affiliate.index') }}" class="hover:text-yellow-400">Configurações</a>
                </nav>

                <!-- Botão sair -->
                <a href="{{ route('logout') }}" class="bg-yellow-600 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded-lg transition">Sair</a>
            </div>

            <!-- Mobile -->
            <div class="md:hidden py-4 relative">
                <div class="text-center text-xl font-bold text-yellow-400">
                    Olá, {{ Auth::user()->name }}
                </div>

                <div class="flex justify-center mt-4 gap-4">
                    <button onclick="toggleMobileMenu()" class="text-white border border-yellow-500 rounded-lg px-4 py-2">Menu</button>
                    <a href="{{ route('logout') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-2 px-4 rounded-lg transition">Sair</a>
                </div>

                <!-- Menu Mobile -->
                <div id="mobileMenu" class="hidden fixed inset-0 bg-[#0a0a0a] z-40 flex flex-col items-center justify-center space-y-6 text-xl">
                    <a href="{{ route('affiliate.index') }}" onclick="closeMobileMenu()" class="hover:text-yellow-400">Sorteios</a>
                    <a href="{{ route('affiliate.index') }}" onclick="closeMobileMenu()" class="hover:text-yellow-400">Vendas</a>
                    <a href="{{ route('affiliate.index') }}" onclick="closeMobileMenu()" class="hover:text-yellow-400">Configurações</a>
                    <button onclick="closeMobileMenu()" class="mt-6 text-gray-400 text-sm underline">Fechar</button>
                </div>
            </div>
        </div>
    </header>

        <!-- Conteúdo principal -->
    <main class="min-h-screen flex-1 w-full max-w-7xl mx-auto px-4 py-6">
        {{ $slot }}
    </main>

    <x-alert />

     <!-- Footer -->
    <footer class="bg-[#1a1a1a] text-white py-10 text-center text-sm bottom-0">
        <div class="max-w-5xl mx-auto">
            <p>&copy; 2025 F12 Rifas. Todos os direitos reservados.</p>
            <div class="mt-4">
                <a href="/termos" class="underline mr-4">Termos de Uso</a>
                <a href="/privacidade" class="underline">Política de Privacidade</a>
            </div>
        </div>
    </footer>
</body>
</html>
