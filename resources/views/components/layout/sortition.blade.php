<!-- layout_institucional.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>F12 Rifas - Venda Rifas com Segurança e Controle</title>
</head>

<body class="text-gray-800" style="background-color: #0D0E0D">
    <!-- Navbar -->
    <header class="w-full text-white shadow" style="background-color: #0e0d0d">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">F12 Rifas</h1>
            <nav class="space-x-6">
                <a href="#inicio" class="hover:text-yellow-400">Início</a>
                <a href="#como-funciona" class="hover:text-yellow-400">conta</a>
            </nav>
            {{-- <div>
                <a
                    href="{{ route('login') }}"
                    class="font-semibold mr-2 hover:underline"
                >
                    Acessar
                </a>
                <a
                    href="{{ route('register') }}"
                    class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 font-semibold"
                >
                    Criar Conta
                </a>
            </div> --}}
        </div>
    </header>

    <section class="w-full">
        {{ $slot }}
    </section>

    <!-- Footer -->
    {{-- <footer class="bg-gray-900 text-white py-6 text-center text-sm">
        <div class="max-w-5xl mx-auto">
            <p>&copy; 2025 F12 Rifas. Todos os direitos reservados.</p>
            <div class="mt-2">
                <a href="/termos" class="underline mr-4">Termos de Uso</a>
                <a href="/privacidade" class="underline">Política de Privacidade</a>
            </div>
        </div>
    </footer> --}}
</body>

</html>
