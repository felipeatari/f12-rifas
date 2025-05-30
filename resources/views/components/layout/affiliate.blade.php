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
    <x-affiliate.header />
    <!-- Header -->

    <!-- Conteúdo principal -->
    <main class="min-h-screen flex-1 w-full max-w-7xl mx-auto px-4 py-6">
        {{ $slot }}
    </main>
    <!-- Conteúdo principal -->

    <x-alert />

     <!-- Footer -->
    <footer class="bg-[#1a1a1a] text-white py-10 text-center text-sm bottom-0">
        <div class="max-w-5xl mx-auto">
            <p>&copy; 2025 F12 Rifas. Todos os direitos reservados.</p>
            <div class="mt-4 py-2">
                <a href="{{ route('home.term-of-use') }}" class="underline mr-4">Termos de Uso</a>
                <a href="{{ route('home.privacy-policy') }}" class="underline">Política de Privacidade</a>
            </div>
        </div>
    </footer>
</body>
</html>
