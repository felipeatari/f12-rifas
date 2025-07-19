<x-layout.sortition sortitionId="{{ $sortitionId }}">
<div class="w-full flex items-center flex-col">
    <div class="w-[200px] flex justify-start my-5">
        <a
            {{-- href="{{ route('customer.index') }}" --}}
        >
            Voltar
        </a>
    </div>

    <span class="my-2 font-bold">Sorteio N #{{ $sortitionId }}</span>
    <span>Valor da Compra R$ {{ $valueTotal }}</span><br>
    <canvas width="100" id="qrcode-canvas" class="bg-white"></canvas>

    <input
        class="w-[200px] text-xs px-2 py-2 my-2 border rounded bg-white text-gray-800 inline-block align-middle"
        type="text" id="pixCode" value="{{ $pixCopiaECola }}" readonly
    >
    <button class="w-[200px] flex justify-center bg-emerald-600 py-3 font-semibold text-white" onclick="copyPixCode()">
        <span class="mr-[10px]">
            Copiar Código Pix
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20px">
            <path fill="white" d="M208 0L332.1 0c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9L448 336c0 26.5-21.5 48-48 48l-192 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48zM48 128l80 0 0 64-64 0 0 256 192 0 0-32 64 0 0 48c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 176c0-26.5 21.5-48 48-48z"/>
        </svg>
    </button>

    <span class="w-[200px] text-xs mt-5 font-semibold">Atenção: Você tem 15 minutos para efetuar o pagamento. <br>Após esse período será necessário gerar uma nova cobrança Pix.</span>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const pixCopiaECola = '{{ $pixCopiaECola }}';
        QRCode.toCanvas(
            document.querySelector('#qrcode-canvas'),
            pixCopiaECola,
            { width: 200 }
        );
    });

    function copyPixCode() {
        const input = document.querySelector('#pixCode');
        input.select();
        input.setSelectionRange(0, 99999); // mobile

        navigator.clipboard.writeText(input.value).then(() => {
            alert('Código Pix copiado!');
        }).catch(() => {
            alert('Erro ao copiar Pix.');
        });
    }
</script>
</x-layout.sortition>
