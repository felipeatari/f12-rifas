@vite('resources/css/app.css')
<div class="bg-[#111111] text-white py-12 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('home.index') }}" class="text-sm text-yellow-400 hover:underline">← Voltar ao site</a>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-yellow-400 mb-8 text-center">Termos de Uso</h1>

        <div class="space-y-6 text-sm md:text-base leading-relaxed text-gray-200">
            <p>Estes Termos de Uso regulam o acesso e uso da plataforma F12 Rifas, disponível em f12rifas.com.br, operada pela CriCode Desenvolvimento de Software Ltda. Ao utilizar a plataforma, você concorda com os termos descritos abaixo.</p>

            <h2 class="text-yellow-400 font-semibold text-lg mt-6">1. Objetivo da Plataforma</h2>
            <p>A F12 Rifas é uma plataforma digital de intermediação que permite que pessoas físicas organizem e vendam suas próprias rifas online. Atuamos exclusivamente como tecnologia de apoio e hospedagem, oferecendo ferramentas para divulgação, controle de cotas e processamento de pagamentos.</p>

            <h2 class="text-yellow-400 font-semibold text-lg mt-6">2. Responsabilidades do Organizador</h2>
            <p>O organizador (vendedor) é integralmente responsável pela realização do sorteio, entrega do prêmio e cumprimento de todas as obrigações relacionadas à sua rifa. A plataforma não se responsabiliza por fraudes, prêmios não entregues ou sorteios não realizados.</p>

            <h2 class="text-yellow-400 font-semibold text-lg mt-6">3. Comissão da Plataforma</h2>
            <p>A F12 Rifas retém automaticamente uma comissão de 10% sobre cada cota vendida, a título de taxa de intermediação e uso da plataforma.</p>

            <h2 class="text-yellow-400 font-semibold text-lg mt-6">4. Conduta Proibida</h2>
            <p>Não é permitido publicar rifas com prêmios ilegais, prometer valores em dinheiro, ou promover atividades que violem a legislação brasileira. A plataforma se reserva o direito de remover rifas a qualquer momento, sem aviso prévio, em caso de suspeita de fraude ou descumprimento das regras.</p>

            <h2 class="text-yellow-400 font-semibold text-lg mt-6">5. Privacidade dos Usuários</h2>
            <p>Os dados coletados são utilizados exclusivamente para viabilizar o funcionamento da plataforma, conforme descrito em nossa <a href="{{ route('home.privacy-policy') }}" class="underline text-yellow-400">Política de Privacidade</a>.</p>

            <h2 class="text-yellow-400 font-semibold text-lg mt-6">6. Disposições Finais</h2>
            <p>Estes termos podem ser atualizados a qualquer momento, sendo responsabilidade do usuário consultá-los periodicamente. O uso contínuo da plataforma implica concordância com as alterações.</p>
        </div>
    </div>
</div>
