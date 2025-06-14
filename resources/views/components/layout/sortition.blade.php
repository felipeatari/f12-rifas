<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon.ico') }}">
    <title>Sorteio #{{ $sortitionId }}</title>
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
    <!-- Conteúdo principal -->
    <main class="min-h-screen flex-1 w-full max-w-7xl mx-auto px-4 py-6">
        {{ $slot }}
    </main>
    <!-- Conteúdo principal -->

    {{-- @php
        $message = 'Número indisponível: 0001';
        $message .= "<br>Você pode continuar selecionando ou clicar em 'checkout' para continuar.";
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Pronto!', "{!! $message !!}", 'success');
        })
    </script> --}}

    <x-alert />

    <!-- Footer -->
    <footer class=" text-white py-10 text-center text-sm bottom-0">
        <div class="max-w-5xl mx-auto">
            <p>&copy; 2025 F12 Rifas. Todos os direitos reservados.</p>
        </div>
    </footer>
    <!-- Footer -->
</body>
</html>
