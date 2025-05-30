<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Somos a F12 Rifas, uma plafatorma focada em pequenos e medios sorteios, ideal para rifas solidárias, Pix na conta e sorteios pessoais. Cadastre-se gratuitamente de forma simplificada e já comece a vender. Só cobramos commisão por números vendidos. Nossa taxa mínia é 10%.">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon.ico') }}">
    <title>F12 Rifas</title>
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
    <x-home.header />

    <main class="w-full">
        {{ $slot }}
    </main>

    @if (app()->environment('production'))
        <style>
            .swal2-icon.swal2-info {
                border-color: #facc15 !important;
                /* Borda do círculo */
                color: #facc15 !important;
                /* Cor do ícone (i) */
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Em desenvolvimento',
                    text: 'Este site ainda está em desenvolvimento. Algumas funcionalidades podem não estar disponíveis.',
                    icon: 'info',
                    confirmButtonText: 'Entendi',
                    background: '#1a1a1a',
                    color: '#fff',
                    customClass: {
                        confirmButton: 'bg-yellow-400 hover:bg-yellow-500 text-black font-bold px-4 py-2 rounded focus:outline-none'
                    },
                    buttonsStyling: false
                });
            });
        </script>
    @endif

    <!-- Footer -->
    <footer class="bg-[#111111] text-white py-10 text-center text-sm">
    <div class="max-w-5xl mx-auto">
        <p>&copy; 2025 F12 Rifas. Todos os direitos reservados.</p>

        <p class="my-4 text-gray-00 max-w-3xl mx-auto text-xs">
            A F12 Rifas é uma plataforma digital de intermediação que permite que pessoas físicas organizem e vendam suas próprias rifas online. Atuamos apenas como tecnologia de apoio e hospedagem, cobrando comissão por cota vendida. A responsabilidade pelo sorteio e entrega do prêmio é do organizador da rifa.
        </p>

        <div>
            <a href="{{ route('home.term-of-use') }}" class="underline mr-4">Termos de Uso</a>
            <a href="{{ route('home.privacy-policy') }}" class="underline">Política de Privacidade</a>
        </div>
    </div>
</footer>
</body>
</html>
