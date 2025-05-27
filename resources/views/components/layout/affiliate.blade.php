<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afiliado</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0d0d0d] text-white min-h-screen flex flex-col font-sans">
    <!-- Header / Navigation -->
    <header class="w-full bg-[#1a1a1a] shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-yellow-400">
                Painel do Afiliado
            </div>
            <nav class="flex items-center gap-4">
                <a href="{{ route('affiliate') }}" class="text-yellow-400 hover:text-yellow-300 transition">
                    Meus Sorteios
                </a>
                <a href="{{ route('logout') }}" class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-300 transition font-semibold">
                    Sair
                </a>
            </nav>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="flex-1 w-full max-w-7xl mx-auto px-4 py-6">
        {{ $slot }}
    </main>

    <!-- Rodapé -->
    <footer class="w-full bg-[#1a1a1a] text-center text-sm py-4 mt-6 text-gray-400">
        &copy; {{ date('Y') }} Plataforma de Rifas. Todos os direitos reservados.
    </footer>
</body>
</html>
