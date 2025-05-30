<x-layout.app>
    <!-- Home Banner -->
    <div id="home" class="bg-[#0a0a0a] text-center w-full h-screen">
        <section class="w-full h-full flex flex-col justify-evenly">
            <div class="w-full flex flex-col items-center">
                <div class="text-center mb-10">
                    <h1 class="text-8xl font-extrabold text-yellow-400">F12 RIFAS</h1>
                </div>
                <p class="max-w-[400px] text-xl text-gray-300 mt-10 px-2">
                    Uma plataforma simples e objetiva, focada em pequenas e médias campanhas. <br>
                    <span class="font-semibold">Cadastre sorteios, gerencie vendas e receba via Pix com segurança.</span>
                </p>
            </div>

            <div class="w-full flex justify-center">
                <a href="{{ route('register') }}"
                    class="w-[250px] md:w-[400px] bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg text-lg transition"
                >
                    Cadastre-se
                </a>
            </div>
        </section>
    </div>
    <!-- Home Banner -->

    <!-- Como Funciona -->
    <section id="como-funciona" class="bg-[#111111] flex flex-col justify-around items-center py-16 px-4 h-screen">
        <h2 class="text-3xl font-bold text-yellow-400 mb-10">Como funciona?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="bg-[#070606] p-6 rounded-lg border border-yellow-500">
                <p class="text-xl font-bold mb-2">1 - Crie a sua conta</p>
                <p class="text-gray-300">Cadastre-se gratuitamente com seu WhatsApp e em poucos cliques. É rápido,
                    simples e sem burocracia.</p>
            </div>
            <div class="bg-[#070606] p-6 rounded-lg border border-yellow-500">
                <p class="text-xl font-bold mb-2">2 - Configure sua campanha</p>
                <p class="text-gray-300">Acesse o painel completo para criar e gerenciar sua campanha. Adicione título,
                    descrição, valor e total de participantes.</p>
            </div>
            <div class="bg-[#070606] p-6 rounded-lg border border-yellow-500">
                <p class="text-xl font-bold mb-2">3 - Publique e arrecade!</p>
                <p class="text-gray-300">Finalize sua campanha e comece a arrecadar. Os valores vão direto para a sua
                    conta via Pix.</p>
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
     <!-- Como Funciona -->

    <!-- Por que usar -->
    <section id="porque-usar" class="bg-[#0a0a0a] py-16 px-4 h-screen">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-yellow-400 text-center mb-12">Por que usar o F12 Rifas?</h2>

            <div class="space-y-12">
                <!-- Item 1 -->
                <div class="flex flex-col md:flex-row md:items-start md:gap-6">
                    <div class="text-4xl font-bold text-yellow-500 mb-2 md:mb-0 md:w-12">01</div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Gestão simples e eficiente das rifas</h3>
                        <p class="text-gray-300">
                            Com o F12 Rifas, você tem controle total sobre os números vendidos, status dos pagamentos e
                            gerenciamento completo da sua campanha de forma intuitiva e prática.
                        </p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="flex flex-col md:flex-row md:items-start md:gap-6">
                    <div class="text-4xl font-bold text-yellow-500 mb-2 md:mb-0 md:w-12">02</div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Receba direto na conta via Pix</h3>
                        <p class="text-gray-300">
                            As contribuições dos participantes são repassadas automaticamente para sua conta bancária
                            via Pix. Sem burocracia ou atrasos.
                        </p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="flex flex-col md:flex-row md:items-start md:gap-6">
                    <div class="text-4xl font-bold text-yellow-500 mb-2 md:mb-0 md:w-12">03</div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Sorteios auditáveis e seguros</h3>
                        <p class="text-gray-300">
                            O sistema gera sorteios automatizados com total transparência, garantindo a confiança dos
                            participantes com resultados auditáveis.
                        </p>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="flex flex-col md:flex-row md:items-start md:gap-6">
                    <div class="text-4xl font-bold text-yellow-500 mb-2 md:mb-0 md:w-12">04</div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Cadastro rápido e suporte</h3>
                        <p class="text-gray-300">
                            Comece em poucos minutos com cadastro pelo WhatsApp e tenha suporte técnico disponível para
                            tirar dúvidas e resolver qualquer questão.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Por que usar -->
</x-layout.app>
