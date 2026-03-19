@props(['images', 'mainImage', 'title' => 'Галерея'])

@php
    $currentMain = $mainImage ?: $images->first();
@endphp

<div class="flex flex-col gap-4">
    {{-- Главное фото --}}
    <div class="main-image-wrapper rounded-lg shadow-sm h-[250px] xl:h-[350px] overflow-hidden bg-white border border-gray-100">
        <div id="main-link" class="cursor-zoom-in h-full w-full" onclick="openFancyboxFromMain()">
            @if($currentMain)
                <img src="{{ asset('storage/' . $currentMain->path) }}" 
                     id="main-img"
                     alt="{{ $title }}" 
                     class="w-full h-full rounded-lg object-cover transition-opacity duration-200">
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">Нет фото</div>
            @endif
        </div>
    </div>

    {{-- Миниатюры --}}
    @if($images->count() > 0)
        <div class="grid grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach($images as $image)
                <div class="thumbnail-container rounded-lg shadow-sm cursor-pointer hover:ring-2 hover:ring-[#FFC059] transition-all duration-200 overflow-hidden h-[124px] bg-white border-2 {{ ($currentMain && $image->id == $currentMain->id) ? 'border-[#FFC059]' : 'border-transparent' }}">
                    <img src="{{ asset('storage/' . $image->path) }}" 
                         class="thumbnail-img w-full h-full object-cover rounded-lg"
                         data-full="{{ asset('storage/' . $image->path) }}"
                         onclick="changeMainImage(this)"
                         alt="Миниатюра">
                    
                    <a href="{{ asset('storage/' . $image->path) }}" 
                       data-fancybox="gallery" 
                       class="hidden fancy-link"></a>
                </div>
            @endforeach
        </div>
    @endif
</div>

@once
<script>
    function changeMainImage(element) {
        const fullPath = element.getAttribute('data-full');
        const mainImg = document.getElementById('main-img');
        
        if (!mainImg) {
            const wrapper = document.getElementById('main-link');
            wrapper.innerHTML = `<img src="${fullPath}" id="main-img" class="w-full h-full rounded-lg object-cover transition-opacity duration-200">`;
        } else {
            mainImg.classList.add('opacity-0');
            setTimeout(() => {
                mainImg.src = fullPath;
                mainImg.classList.remove('opacity-0');
            }, 150);
        }

        // Подсветка активной миниатюры
        document.querySelectorAll('.thumbnail-container').forEach(c => {
            c.classList.remove('border-[#FFC059]');
            c.classList.add('border-transparent');
        });
        element.closest('.thumbnail-container').classList.remove('border-transparent');
        element.closest('.thumbnail-container').classList.add('border-[#FFC059]');
    }

    function openFancyboxFromMain() {
        const mainImg = document.getElementById('main-img');
        if (!mainImg) return;

        const currentSrc = mainImg.src;
        
        const links = Array.from(document.querySelectorAll('.fancy-link'));
        const targetLink = links.find(l => {
            const linkHref = new URL(l.getAttribute('href'), window.location.origin).pathname;
            const currentPath = new URL(currentSrc, window.location.origin).pathname;
            return linkHref === currentPath;
        });

        if (targetLink) {
            targetLink.click();
        } else if (links.length > 0) {
            links[0].click();
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        Fancybox.bind("[data-fancybox='gallery']", { 
            dragToClose: true,
            compact: false 
        });
    });
</script>
@endonce