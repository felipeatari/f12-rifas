<x-layout.sortition sortitionId="{{ $sortition->id }}">
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
                </div>
            @else
                <div class="w-full py-2 mt-4 bg-red-500 hover:bg-red-600 text-black font-semibold rounded text-center">
                    Não restam mais números</div>
            @endif

            <div id="numberContainer"
                class="w-full h-[400px] overflow-y-auto flex flex-wrap justify-center items-start mt-5 py-1 bg-[#0d0d0d] rounded custom-scrollbar">
                @foreach ($sortition->getNumbers() as $item)
                    <div
                        class="number-box border border-[#facc15] text-[#facc15] rounded-full min-w-14 h-14 p-2 m-1 flex items-center justify-center font-semibold text-sm cursor-pointer transition-colors duration-200"
                        data-number="{{ $item->number_str }}"
                        id="number-{{ $item->number_str }}"
                        onclick="selectNumber('{{ $item->number_str }}')"
                        >
                        {{ $item->number_str }}
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                <table class="w-full bg-[#0d0d0d] rounded-xl">
                    <thead>
                        <tr>
                            <th class="text-start pl-4 pt-2 text-[#facc15]">Carrinho</th>
                            <th class="text-end pr-4 pt-2">
                                <button id="clean-session-numbers" style="display: none" onclick="cleanSessionNumbers()" class="w-[80px] bg-[#facc15] text-black">Limpar</button>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-start pl-4 pt-4 font-semibold">Número(s)</th>
                            <th class="text-end pr-4 pt-4 font-semibold">Qtd. Número(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text pl-4 pt-1 pb-2 text-[#facc15] text-xs" id="numbers-selected"></td>
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
                <div id="numbers"></div>

                <input required type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nome"
                    class="w-full p-2 my-1 text-white border border-[#363333] rounded">

                <input required type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}"
                    placeholder="WhatsApp" class="w-full p-2 my-1 text-white border border-[#363333] rounded">

                <input required type="text" name="cpf" id="cpf" value="{{ old('cpf') }}" placeholder="CPF"
                    class="w-full p-2 mt-1 mb-2 text-white border border-[#363333] rounded">

                <button
                    id="check-available-numbers"
                    class="w-full bg-green-500 hover:bg-green-600 text-black text-sm font-bold py-2 rounded-md transition duration-200"
                    {{-- type="button"
                    onclick="checkout()" --}}
                >
                    Checkout
                </button>
            </form>
        </div>
    </div>

    <script>
        let selectedTd = document.querySelector('#numbers-selected')
        let amountTd = document.querySelector('#numbers-amount')
        let subUnTd = document.querySelector('#value-un')
        let subTotalTd = document.querySelector('#value-total')
        let price = 0
        let numbersSelected = []
        let numbersSelectedQtd = 0

        const loadNumbers = () => {
            fetch(`{{ route('sortition.load-numbers') }}?sorteio={{ $sortition->id }}`)
                .then(response => response.json())
                .then(response => {
                    if (response.status === 'error') {
                        alert(response.message)

                        return
                    }

                    let dataKey = 'sortition{{ $sortition->id }}'

                    if (!dataKey in response) {
                        return
                    }

                    let data = response[dataKey]

                    if (data.length > 0) {
                        data.forEach(n => {
                            selectNumber(n)
                        })
                    }
                })
                .catch(error => {
                    console.error(error)
                })
        }

        const selectNumber = (number) => {
            const numberSelected = document.querySelector(`#number-${number}`)

            if (numberSelected.classList.contains('bg-[#facc15]')) {
                numberSelected.classList.remove('bg-[#facc15]', 'text-black')
                numberSelected.classList.add('text-[#facc15]')

                const index = numbersSelected.indexOf(number)
                if (index > -1) {
                    numbersSelected.splice(index, 1)
                }
            } else {
                numberSelected.classList.add('bg-[#facc15]', 'text-black')
                numberSelected.classList.remove('text-[#facc15]')
                numbersSelected.push(number)
                numbersSelectedQtd = numbersSelected.length
            }

            numbersSelectedQtd = numbersSelected.length

            if (numbersSelectedQtd === 0) {
                selectedTd.textContent = ''
                amountTd.textContent = '0'
                subUnTd.textContent = 'R$ 0'
                subTotalTd.textContent = 'R$ 0'

                return
            }

            const numerosFormatados = numbersSelected
                .map(n => n.toString())
                .join(', ')

            price = '{{ $sortition->price }}'

            const subTotal = numbersSelectedQtd * price

            selectedTd.textContent = numerosFormatados
            amountTd.textContent = numbersSelectedQtd.toString()
            subUnTd.textContent = 'R$ ' + price
            subTotalTd.textContent = 'R$ ' + subTotal

            document.querySelector('#clean-session-numbers').style.display = 'initial'

            const container = document.querySelector('#numbers')

            container.innerHTML = '';

            numbersSelected.forEach(numero => {
                const input = document.createElement('input')
                input.type = 'hidden';
                input.name = 'numbers[]';
                input.value = numero;
                container.appendChild(input);
            });
        }

        const checkout = ()=> {
            fetch('{{ route('sortition.checkout') }}', {
                method: 'POST',
                body: JSON.stringify({
                    numbers: numbersSelected,
                    sortition_id: '{{ $sortition->id }}'
                }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => response.json())
            .then(response => {
                if (response.status === 'error') {
                    alert(response.message)

                    return
                }

                if (response.status === 'warning') {
                    alert(response.message)

                    window.location.reload(true)

                    return
                }

                console.log(response.data)
            })
            .catch(error => {
                console.error('Erro:', error);
            })
        }

        const cleanSessionNumbers = ()=> {
            fetch('{{ route('sortition.clean-numbers-selected') }}')
            .then(response => response.json())
            .then(response => {
                loadNumbers()

                window.location.reload(true)
            })
            .catch(error => {
                console.error('Erro:', error);
            })
        }

        loadNumbers()
    </script>
</x-layout.sortition>
