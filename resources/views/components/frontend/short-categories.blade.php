<div class="flex flex-col gap-4">
    <div class="flex items-center justify-between">
        <h2 class="font-bold text-xl xl:text-2xl">Прицепы</h2>
        <a href="{{route('trailer.index')}}" class="flex items-center gap-2 hover:text-[#e28c00] transition duration-300 ease-linear">
            Все прицепы
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5"/>
                    <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0z"/>
                </svg>
            </span>
        </a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @forelse ($categories as $category)
            <a href="#" class="rounded-lg h-[150px] xl:h-[200px] 2xl:h-[280px] relative overflow-hidden">
                @if($category->main_image)
                    <img src="{{ asset('storage/' . $category->main_image->path) }}" 
                        alt="{{ $category->name }}" 
                        class="w-full h-full object-cover rounded-lg">
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-lg">Нет фото</div>
                @endif
                <div class="card-black-glass absolute bottom-0 left-0 w-full py-6 flex justify-center">
                    <span class="text-white font-semibold">{{ $category->name }}</span>
                </div>
            </a>
        @empty
            <div class="col-span-4">
                <span>В данный момент нет прицепов.</span>
            </div>
        @endforelse
    </div>
</div>