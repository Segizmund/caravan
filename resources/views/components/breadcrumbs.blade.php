@props(['links' => []])

<nav class="flex items-center text-sm lg:text-base" aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center gap-2">
        {{-- Главная — выводится всегда первой --}}
        <li class="inline-flex items-center">
            <a href="{{ route('home.index') }}" class="inline-flex items-center font-medium hover:text-[#e28c00] transition-colors">
                Главная
            </a>
        </li>

        @foreach($links as $link)
            <li>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                    
                    @if(isset($link['url']) && !$loop->last)
                        <a href="{{ $link['url'] }}" class="hover:text-[#e28c00] transition-colors">
                            {{ $link['title'] }}
                        </a>
                    @else
                        <span class="text-gray-400">
                            {{ $link['title'] }}
                        </span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>