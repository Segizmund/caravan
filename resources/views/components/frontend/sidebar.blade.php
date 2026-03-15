<div class="flex flex-col gap-8">
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl">Информация</h2>
            <a href="#" class="flex items-center gap-2 hover:text-[#e28c00] transition duration-300 ease-linear">
                Еще
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5"/>
                        <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0z"/>
                    </svg>
                </span>
            </a>
        </div>
        <div class="flex flex-col gap-3">
            @forelse ($sidebarInfo as $info)
                <a href="#" class="rounded-lg bg-white py-3 px-6">
                    <span class="font-medium">{{ $info->title }}</span>
                </a>
            @empty
                <div>
                    <span>Информация скоро появиться.</span>
                </div>
            @endforelse
        </div>
    </div>

    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl">Обновления</h2>
            <a href="#" class="flex items-center gap-2 hover:text-[#e28c00] transition duration-300 ease-linear">
                Еще
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5"/>
                        <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0z"/>
                    </svg>
                </span>
            </a>
        </div>
        <div class="flex flex-col gap-3">
            @forelse ($sidebarNews as $news)
                <a href="#" class="rounded-lg h-[150px] relative overflow-hidden">
                    @if($news->main_image)
                        <img src="{{ asset('storage/' . $news->main_image->path) }}" 
                            alt="{{ $news->title }}" 
                            class="w-full h-full object-cover rounded-lg">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-lg">Нет фото</div>
                    @endif
                    <div class="card-black-glass absolute bottom-0 left-0 w-full py-1.5 flex justify-center">
                        <span class="text-white font-semibold">{{ $news->title }}</span>
                    </div>
                </a>
            @empty
                <div>
                    <span>В данный момент нет ниодной активной услуги.</span>
                </div>
            @endforelse
        </div>
    </div>
</div>