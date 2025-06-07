<x-layout.sortition>
    <div class="w-full flex flex-col items-center my-10 px-2 md:px-0">
        <div class="w-full max-w-[400px]">
            <div class="w-full text-center">
                <h1 class="text-3xl text-center font-semibold mb-2">{{ $sortition->title }}</h1>
                <p class="text-sm">{{ $sortition->description }}</p>

                <p class="text-6xl text-yellow-500 font-bold mt-4">R$ {{ number_format($sortition->price, 2, ',') }} Nº
                </p>
            </div>

            @if ($image = $sortition->image)
                <div
                    class="min-w-[200px] h-[300px] my-10 flex items-center justify-center border border-[#363333] overflow-hidden">
                    <img src="{{ asset($image) }}" alt="Imagem do sorteio" class="h-full w-auto object-contain" />
                </div>
            @else
                <div class="my-10"></div>
            @endif

            @if ($numbers = $sortition->getNumbers()->count())
                <div class="w-full flex flex-col items-center">
                    <span class="font-semibold">Restam {{ $numbers }} números</span>
                    {{-- <button id="toggleButton"
                        class="w-full py-2 mt-4 bg-yellow-500 hover:bg-yellow-600 text-black font-semibold rounded">
                        Toque para ver
                    </button> --}}
                </div>
            @else
                <div class="w-full py-2 mt-4 bg-red-500 hover:bg-red-600 text-black font-semibold rounded text-center">
                    Não restam mais números</div>
            @endif

            <div id="numberContainer"
                class="w-full h-[400px] overflow-y-auto flex flex-wrap justify-center items-start mt-5 py-1 bg-[#0d0d0d] rounded custom-scrollbar">
                @foreach ($sortition->getNumbers() as $item)
                    <div class="number-box border border-[#facc15] text-[#facc15] rounded-full min-w-14 h-14 p-2 m-1 flex items-center justify-center font-semibold text-sm cursor-pointer transition-colors duration-200"
                        data-number="{{ $item->number_str }}">
                        {{ $item->number_str }}
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                <table class="w-full bg-[#0d0d0d] rounded-xl">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-start pl-4 pt-2 text-[#facc15]">Carrinho</th>
                        </tr>
                        <tr>
                            <th class="text-start pl-4 pt-4 font-semibold">Número(s)</th>
                            <th class="text-end pr-4 pt-4 font-semibold">Qtd. Números</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text pl-4 pt-1 pb-2" id="numbers-selected"></td>
                            <td class="text-end pr-4 pt-1 pb-2" id="numbers-amount"></td>
                        </tr>
                        <tr>
                            <td class="text pl-4 pt-1 pb-2">Valor Un</td>
                            <td class="text-end pr-4 pt-1 pb-2" id="value-un"></td>
                        </tr>
                        <tr>
                            <td class="text pl-4 pt-1 pb-2">Valor Total</td>
                            <td class="text-end pr-4 pt-1 pb-2" id="value-total"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <form class="w-full mt-5" method="POST" action="{{ route('sortition.checkout') }}">
                @csrf
                <input type="hidden" name="sortition_id" value="{{ $sortition->id }}" id="sortition_id">
                {{-- <input type="hidden" name="numbers[]" value="{{ $sortition->id }}" id="numbers"> --}}
                <div id="hidden-numbers-wrapper"></div>

                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nome"
                    class="w-full p-2 my-1 text-white border border-[#363333] rounded">

                <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}"
                    placeholder="WhatsApp" class="w-full p-2 my-1 text-white border border-[#363333] rounded">

                <input type="text" name="cpf" id="cpf" value="{{ old('cpf') }}" placeholder="CPF"
                    class="w-full p-2 mt-1 mb-2 text-white border border-[#363333] rounded">

                <button
                    id="check-available-numbers"
                    class="w-full bg-green-500 hover:bg-green-600 text-black text-sm font-bold py-2 rounded-md transition duration-200">
                    Checkout
                </button>
            </form>
        </div>
    </div>

    <script>
        // localStorage.clear();
        const STORAGE_KEY = 'selectedNumbers'; // chave global

        document.addEventListener('DOMContentLoaded', function() {
            const numberBoxes = document.querySelectorAll('.number-box');
            const savedNumbers = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

            // Marcar os que estavam salvos
            numberBoxes.forEach(box => {
                const number = box.dataset.number;

                if (savedNumbers.includes(number)) {
                    box.classList.add('bg-[#facc15]', 'text-black');
                    box.classList.remove('text-[#facc15]');
                }

                box.addEventListener('click', () => {
                    const index = savedNumbers.indexOf(number);
                    const isSelected = index > -1;

                    if (isSelected) {
                        // Desmarcar
                        savedNumbers.splice(index, 1);
                        box.classList.remove('bg-[#facc15]', 'text-black');
                        box.classList.add('text-[#facc15]');
                    } else {
                        // Marcar
                        savedNumbers.push(number);
                        box.classList.add('bg-[#facc15]', 'text-black');
                        box.classList.remove('text-[#facc15]');
                    }

                    localStorage.setItem(STORAGE_KEY, JSON.stringify(savedNumbers));

                    updateSelectedNumbers();
                });
            });
        });

        // function checkAvailableNumbers() {
        //     let savedNumbers = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

        //     const data = {
        //         sortition_id: {{ $sortition->id }},
        //         numbers: savedNumbers
        //     }

        //     fetch('{{ route('sortition.checkout') }}', {
        //         method: 'POST',
        //         body: JSON.stringify(data),
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-Requested-With': 'XMLHttpRequest',
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //     })
        //     .then(response => response.json())
        //     .then(response => {
        //         if (response.length > 0) {
        //             const numbersNotAvailable = response.map(n => String(n)); // normaliza se necessário
        //             const originalSavedNumbers = [...savedNumbers];

        //             // Remove números indisponíveis
        //             savedNumbers = savedNumbers.filter(n => !numbersNotAvailable.includes(n));
        //             const numbersNotSaved = originalSavedNumbers.filter(n => numbersNotAvailable.includes(n));

        //             localStorage.setItem(STORAGE_KEY, JSON.stringify(savedNumbers));

        //             // Atualiza visualmente os botões
        //             const numberBoxes = document.querySelectorAll('.number-box');
        //             numberBoxes.forEach(box => {
        //                 const number = box.dataset.number;

        //                 if (savedNumbers.includes(number)) {
        //                     box.classList.add('bg-[#facc15]', 'text-black');
        //                     box.classList.remove('text-[#facc15]');
        //                 } else {
        //                     box.classList.remove('bg-[#facc15]', 'text-black');
        //                     box.classList.add('text-[#facc15]');
        //                 }
        //             });

        //             // Atualiza a exibição do resumo
        //             updateSelectedNumbers();

        //              if (numbersNotSaved && numbersNotSaved.length > 0) {
        //                 let messageAlert = '';

        //                 if (numbersNotAvailable.length == 1) {
        //                     messageAlert = `O número ${numbersNotSaved.map(n => n)} não está mais disponíveil.`;
        //                 } else {
        //                     messageAlert = `Os números: ${numbersNotSaved.map(n => n).join(', ')}, não estão mais disponíveis.`;
        //                 }

        //                 alert(messageAlert)

        //                 window.location.reload(true);
        //             }
        //         } else {
        //             checkout(data)
        //         }
        //     })
        //     .catch(error => {
        //         console.error('Erro:', error);
        //     });
        // }

        function updateSelectedNumbers() {
            const selectedTd = document.querySelector('#numbers-selected');
            const amountTd = document.querySelector('#numbers-amount');
            const subUnTd = document.querySelector('#value-un');
            const subTotalTd = document.querySelector('#value-total');
            const price = {{ $sortition->price }};
            const savedNumbers = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
            const savedNumbersLength = savedNumbers.length;

            const wrapper = document.getElementById('hidden-numbers-wrapper');

            if (savedNumbersLength === 0) {
                selectedTd.textContent = '000';
                amountTd.textContent = '0';
                subUnTd.textContent = 'R$ 0';
                subTotalTd.textContent = 'R$ 0';

                if (numbers) {
                    numbers.value = ''; // Limpa o campo se não houver números
                }
            } else {
                const numerosFormatados = savedNumbers
                    .map(n => n.toString())
                    .join(', ');

                const subTotal = savedNumbersLength * price;

                selectedTd.textContent = numerosFormatados;
                amountTd.textContent = savedNumbersLength.toString();
                subUnTd.textContent = 'R$ ' + price;
                subTotalTd.textContent = 'R$ ' + subTotal;

                wrapper.innerHTML = '';

                savedNumbers.forEach(number => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'numbers[]';
                    input.value = number;
                    wrapper.appendChild(input);
                });
            }
        }

        // function checkout(data) {
        //     fetch('{{ route('sortition.checkout') }}', {
        //         method: 'POST',
        //         body: JSON.stringify(data),
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-Requested-With': 'XMLHttpRequest',
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //     })
        //     .then(response => response.json())
        //     .then(response => {
        //         console.log('Sucesso:', response);
        //     })
        //     .catch(error => {
        //         console.error('Erro:', error);
        //     });
        // }

        // Atualiza os números ao carregar
        updateSelectedNumbers();
    </script>
</x-layout.sortition>
