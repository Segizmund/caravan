@foreach($trailers as $trailer)
    <div class="bg-white p-3 rounded-lg flex flex-col gap-4 trailer-card">
        @if($mainImage = $trailer->images->first())
            <div>
                <img class="h-[180px] xl:h-[230px] w-full object-cover rounded-lg" src="{{ asset('storage/' . $mainImage->path) }}" alt="{{ $trailer->name }}">
            </div>
        @else
            <div class="h-[180px] xl:h-[230px] w-full bg-gray-300 flex items-center justify-center rounded-lg">
                <span class="text-white">Нет фото.</span>
            </div>
        @endif
            <div class="flex flex-col gap-2">
                <a href="{{ route('trailers.show', $trailer) }}" class="flex items-center gap-2 hover:text-[#e28c00] transition duration-300 ease-linear">
                    <span class="font-semibold">{{$trailer->name}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5"/>
                        <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0z"/>
                    </svg>
                </a>
                <span>Отзывы: 2</span>
            </div>
            <div class="flex items-center w-full">
                <button popovertarget="connect-us" class="bg-[#FFC059] w-full flex text-white font-semibold py-4 px-2 rounded-lg hover:bg-[#ffaa21] transition duration-300 ease-linear">
                    Задать вопрос
                </button>
            </div>
    </div>
@endforeach