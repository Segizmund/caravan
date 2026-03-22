@extends('layouts.app')
@section('title', 'Галерея')

@section('description', 'Посмотрите фотографии наших легковых прицепов в эксплуатации, детали производства и готовые решения для клиентов. Реальные фото прицепов Караван.')

@section('og_image', asset('img/og-img/og-trailer-cover.webp'))

@section('content')
<div class="h-full flex flex-col justify-between">
    <div class="flex flex-col gap-4">
        <div>
            <h1 class="font-bold text-xl xl:text-2xl">Галерея</h1>
        </div>

        {{-- Сетка изображений --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($images as $image)
                <a href="{{ asset('storage/' . $image->path) }}" 
                    data-fancybox="gallery" 
                    class="group relative aspect-square overflow-hidden rounded-xl bg-gray-100 shadow-sm transition-all hover:shadow-md cursor-zoom-in">
                        
                    <img src="{{ asset('storage/' . $image->path) }}" 
                        alt="Фото галереи" 
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                        </svg>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-12 text-center text-gray-400">
                    Галерея пока пуста.
                </div>
            @endforelse
        </div>

    </div>
    <div class="pagination">
        {{ $images->links() }}
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof Fancybox !== "undefined") {
            
            Fancybox.bind("[data-fancybox]", {
                infinite: true,
                dragToClose: true,
                compact: false,
                showClass: "f-fadeIn",
                
                l10n: {
                    CLOSE: "Закрыть",
                    NEXT: "Следующий",
                    PREV: "Предыдущий",
                },
            });

        }
    });
</script>
@endsection