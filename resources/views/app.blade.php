<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>F12 Rifas</title>
    @vite('resources/css/app.css')
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
            <div class="hidden md:flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="text-2xl font-bold text-yellow-400">F12 Rifas</div>

                <!-- Navigation -->
                <nav class="space-x-8 text-white font-medium">
                    <a href="#home" class="hover:text-yellow-400">Início</a>
                    <a href="#como-funciona" class="hover:text-yellow-400">Como Funciona</a>
                    <a href="#porque-usar" class="hover:text-yellow-400">Por que Usar</a>
                </nav>

                <!-- Botão Conta -->
                @if (Auth::check())
                    <a href="{{ route('painel') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-2 px-4 rounded-lg transition">Minha Conta</a>
                @else
                    <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-2 px-4 rounded-lg transition">Acessar</a>
                @endif
            </div>

            <!-- Mobile Header -->
            <div class="md:hidden py-4 relative">
                <div class="text-center text-2xl font-bold text-yellow-400">F12 Rifas</div>
                <div class="flex justify-center mt-4 gap-4">
                    <button onclick="toggleMobileMenu()" class="text-white border border-yellow-500 rounded-lg px-4 py-2">Menu</button>
                    @if (Auth::check())
                        <a href="{{ route('painel') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-2 px-4 rounded-lg transition">Minha Conta</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-2 px-4 rounded-lg transition">Acessar</a>
                    @endif
                </div>
                <div id="mobileMenu" class="hidden fixed inset-0 bg-[#0a0a0a] z-40 flex flex-col items-center justify-center space-y-6 text-xl">
                    <a href="#home" onclick="closeMobileMenu()" class="hover:text-yellow-400">Início</a>
                    <a href="#como-funciona" onclick="closeMobileMenu()" class="hover:text-yellow-400">Como Funciona</a>
                    <a href="#porque-usar" onclick="closeMobileMenu()" class="hover:text-yellow-400">Por que Usar</a>
                    <button onclick="toggleMobileMenu()" class="mt-6 text-gray-400 text-sm underline">Fechar</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Home Banner -->
    <section id="home" class="bg-[#111111] px-4 text-center h-screen flex flex-col justify-evenly">
        <div class="max-w-5xl mx-auto space-y-6">
            <h1 class="md:text-6xl text-4xl font-extrabold text-yellow-400">Olá, somos a F12 Rifas</h1>
            <p class="text-xl text-gray-300">
                Uma plataforma simples e objetiva, focada em campanhas pequenas e médias.<br>
                Cadastre sorteios, gerencie vendas e receba via Pix com segurança.
            </p>
        </div>

        <div class="w-full flex justify-center mt-10">
            <a href="{{ route('register') }}" class="w-[250px] md:w-[400px] bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg text-lg transition my-8">Cadastre-se</a>
        </div>
    </section>

    <!-- Como Funciona -->
    <section id="como-funciona" class="bg-[#1a1a1a] flex flex-col justify-around items-center py-16 px-4">
        <h2 class="text-3xl font-bold text-yellow-400 mb-10">Como funciona?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="bg-[#070606] p-6 rounded-lg border border-yellow-500">
                <p class="text-xl font-bold mb-2">1 - Crie a sua conta</p>
                <p class="text-gray-300">Cadastre-se gratuitamente com seu WhatsApp e em poucos cliques. É rápido, simples e sem burocracia.</p>
            </div>
            <div class="bg-[#070606] p-6 rounded-lg border border-yellow-500">
                <p class="text-xl font-bold mb-2">2 - Configure sua campanha</p>
                <p class="text-gray-300">Acesse o painel completo para criar e gerenciar sua campanha. Adicione título, descrição, valor e total de participantes.</p>
            </div>
            <div class="bg-[#070606] p-6 rounded-lg border border-yellow-500">
                <p class="text-xl font-bold mb-2">3 - Publique e arrecade!</p>
                <p class="text-gray-300">Finalize sua campanha e comece a arrecadar. Os valores vão direto para a sua conta via Pix.</p>
            </div>
        </div>

        <div class="text-center mt-12">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">Comissões e Repasses</h2>
            <ul class="text-white text-start space-y-2 text-base max-w-xl mx-auto">
                <li>✅ Defina o valor dos números livremente</li>
                <li>✅ Acompanhamento de vendas em tempo real</li>
                <li>✅ Cadastre quantas campanhas quiser</li>
                <li>💰 Comissão da plataforma: a partir de 10% por venda</li>
                <li>📤 Repasse automático via Pix após a compra do número</li>
            </ul>
        </div>
    </section>

    <!-- Por que usar -->
    <section id="porque-usar" class="bg-[#111111] py-16 px-4">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-yellow-400 text-center mb-12">Por que usar o F12 Rifas?</h2>

        <div class="space-y-12">
            <!-- Item 1 -->
            <div class="flex flex-col md:flex-row md:items-start md:gap-6">
                <div class="text-4xl font-bold text-yellow-500 mb-2 md:mb-0 md:w-12">01</div>
                <div>
                    <h3 class="text-xl font-semibold text-white mb-2">Gestão simples e eficiente das rifas</h3>
                    <p class="text-gray-300">
                        Com o F12 Rifas, você tem controle total sobre os números vendidos, status dos pagamentos e gerenciamento completo da sua campanha de forma intuitiva e prática.
                    </p>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="flex flex-col md:flex-row md:items-start md:gap-6">
                <div class="text-4xl font-bold text-yellow-500 mb-2 md:mb-0 md:w-12">02</div>
                <div>
                    <h3 class="text-xl font-semibold text-white mb-2">Receba direto na conta via Pix</h3>
                    <p class="text-gray-300">
                        As contribuições dos participantes são repassadas automaticamente para sua conta bancária via Pix. Sem burocracia ou atrasos.
                    </p>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="flex flex-col md:flex-row md:items-start md:gap-6">
                <div class="text-4xl font-bold text-yellow-500 mb-2 md:mb-0 md:w-12">03</div>
                <div>
                    <h3 class="text-xl font-semibold text-white mb-2">Sorteios auditáveis e seguros</h3>
                    <p class="text-gray-300">
                        O sistema gera sorteios automatizados com total transparência, garantindo a confiança dos participantes com resultados auditáveis.
                    </p>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="flex flex-col md:flex-row md:items-start md:gap-6">
                <div class="text-4xl font-bold text-yellow-500 mb-2 md:mb-0 md:w-12">04</div>
                <div>
                    <h3 class="text-xl font-semibold text-white mb-2">Cadastro rápido e suporte</h3>
                    <p class="text-gray-300">
                        Comece em poucos minutos com cadastro pelo WhatsApp e tenha suporte técnico disponível para tirar dúvidas e resolver qualquer questão.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Footer -->
    <footer class="bg-[#1a1a1a] text-white py-10 text-center text-sm">
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
