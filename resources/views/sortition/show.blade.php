<x-layout.sortition>
    <div class="w-full flex flex-col items-center my-10">
        <div class="w-[400px]">
            <div class="w-full text-center">
                <h1 class="text-3xl text-center font-semibold mb-2">{{ $sortition->title }}</h1>
                <p class="text-sm">{{ $sortition->description }}</p>

                <p class="text-6xl text-yellow-500 font-bold mt-4">R$ {{ number_format($sortition->price, 2, ',') }} Nº
                </p>
            </div>

            @if ($image = $sortition->image)
                <div class="h-[300px] my-10 flex items-center justify-center border border-[#363333] rounded">
                    <img src="{{ $image }}" alt="Imagem do sorteio" class="max-w-[300px] h-auto" />
                </div>
            @else
                <div class="my-10"></div>
            @endif

            {{-- <div class="h-[300px] mt-10 mb-10 flex items-center justify-center border border-[#363333] rounded">
                @if ($image = $sortition->image)
                    <img src="{{ $image }}" alt="Imagem do sorteio" class="max-w-[300px] h-auto" />
                @else
                    <span class="w-[200px] h-[300px] text-sm text-gray-400">Sem imagem</span>
                @endif
            </div> --}}

            @if ($numbers = $sortition->getNumbers()->count())
                <div class="w-full flex flex-col items-center">
                    <span class="font-semibold">Restam {{ $numbers }} números</span>
                    <button id="toggleButton"
                        class="w-full py-2 mt-4 bg-yellow-500 hover:bg-yellow-600 text-black font-semibold rounded">
                        Toque para ver
                    </button>
                </div>
            @else
                <div
                    class="w-full py-2 mt-4 bg-red-500 hover:bg-red-600 text-black font-semibold rounded text-center">
                    Não restam mais números</div>
            @endif

            <div id="numberContainer"
                class="hidden w-full h-[400px] overflow-y-auto flex flex-wrap justify-center items-start mt-5 py-1 bg-[#0d0d0d] rounded custom-scrollbar">
                @foreach ($sortition->getNumbers() as $item)
                    <div class="number-box border border-[#facc15] text-[#facc15] rounded-full min-w-12 h-12 p-2 m-1 flex items-center justify-center font-semibold text-sm cursor-pointer transition-colors duration-200"
                        data-number="{{ $item->number }}">
                        {{ str_pad($item->number, 3, '0', STR_PAD_LEFT) }}
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
                            <th class="text-end pr-4 pt-4 font-semibold">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text pl-4 pt-1 pb-2">2, 7, 21</td>
                            <td class="text-end pr-4 pt-1 pb-2">R$ 30,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <form class="w-full mt-5" method="POST" action="{{ route('affiliate.update', $sortition->id) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nome"
                    class="w-full p-2 my-1 text-white border border-[#363333] rounded">

                <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}"
                    placeholder="WhatsApp" class="w-full p-2 my-1 text-white border border-[#363333] rounded">

                <input type="text" name="cpf" id="cpf" value="{{ old('name') }}" placeholder="CPF"
                    class="w-full p-2 mt-1 mb-2 text-white border border-[#363333] rounded">

                <button type="button"
                    class="w-full bg-green-500 hover:bg-green-600 text-black text-sm font-bold py-2 rounded-md transition duration-200">
                    Checkout
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const numberBoxes = document.querySelectorAll('.number-box');

            numberBoxes.forEach(box => {
                box.addEventListener('click', () => {
                    const isSelected = box.classList.contains('bg-[#facc15]');

                    box.classList.remove('bg-[#facc15]', 'text-black');
                    box.classList.add('text-[#facc15]');

                    if (!isSelected) {
                        box.classList.add('bg-[#facc15]', 'text-black');
                        box.classList.remove('text-[#facc15]');
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
        const button = document.getElementById("toggleButton");
        const container = document.getElementById("numberContainer");

        button.addEventListener("click", () => {
            const isHidden = container.classList.contains("hidden");

            if (isHidden) {
                container.classList.remove("hidden");
                button.textContent = "Toque para fechar";
            } else {
                container.classList.add("hidden");
                button.textContent = "Toque para ver";
            }
        });
    });
    </script>
</x-layout.sortition>
