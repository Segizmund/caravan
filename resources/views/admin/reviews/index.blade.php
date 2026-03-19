@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Управление отзывами</h1>

    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-200">
        {{-- Шапка "таблицы" --}}
        <div class="hidden md:grid grid-cols-[15%_20%_auto_15%_10%] bg-gray-50 border-b border-gray-200 py-3 px-6 text-xs uppercase font-bold text-gray-500 tracking-wider">
            <div>Автор / Дата</div>
            <div>Объект</div>
            <div>Отзыв и Фото</div>
            <div class="text-center">Статус</div>
            <div class="text-right">Действия</div>
        </div>

        {{-- Список отзывов --}}
        <div class="flex flex-col">
            @forelse($reviews as $review)
                <div class="grid grid-cols-1 md:grid-cols-[15%_20%_auto_15%_10%] border-b border-gray-100 last:border-0 p-4 md:px-6 md:py-5 hover:bg-gray-50 transition items-center gap-4">
                    
                    {{-- Автор --}}
                    <div class="flex flex-col gap-1">
                        <span class="font-bold text-gray-900 leading-tight">{{ $review->author_name }}</span>
                        <span class="text-gray-400 text-[11px]">{{ $review->created_at->format('d.m.Y H:i') }}</span>
                    </div>

                    {{-- Объект (Прицеп/Услуга) --}}
                    <div class="flex flex-col gap-1">
                        @if($review->reviewable)
                            <div class="w-fit px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $review->reviewable_type === 'App\Models\Service' ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : 'bg-amber-50 text-amber-600 border border-amber-100' }}">
                                {{ $review->reviewable_type === 'App\Models\Service' ? 'Услуга' : 'Прицеп' }}
                            </div>
                            <span class="text-sm font-medium text-gray-700">{{ $review->reviewable->name }}</span>
                        @else
                            <span class="text-red-400 text-xs italic">Объект удален</span>
                        @endif
                    </div>

                    {{-- Контент: Текст + Фото --}}
                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col gap-1">
                            <div class="flex text-yellow-400 text-xs">
                                @for($i=1; $i<=5; $i++)
                                    <svg class="w-3.5 h-3.5 fill-current {{ $i <= $review->rating ? '' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                @endfor
                            </div>
                            <p class="text-gray-600 text-sm leading-snug italic">"{{ $review->comment }}"</p>
                        </div>

                        {{-- Фотографии отзыва --}}
                        @if($review->images->count() > 0)
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach($review->images as $img)
                                    <a href="{{ asset('storage/' . $img->path) }}" 
                                       data-fancybox="admin-review-{{ $review->id }}" 
                                       class="group relative w-12 h-12 rounded-lg overflow-hidden border border-gray-200 hover:border-[#FFC059] transition">
                                        <img src="{{ asset('storage/' . $img->path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Статус --}}
                    <div class="flex justify-start md:justify-center">
                        <form action="{{ route('admin.reviews.toggle', $review) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-fit px-3 py-1 rounded-full text-[11px] font-bold transition {{ $review->is_approved ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-orange-100 text-orange-700 hover:bg-orange-200' }}">
                                {{ $review->is_approved ? 'Одобрен' : 'На модерации' }}
                            </button>
                        </form>
                    </div>

                    {{-- Действия --}}
                    <div class="flex justify-end">
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Удалить отзыв и все связанные фото?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5.0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="py-12 text-center text-gray-400">Отзывов пока нет.</div>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        {{ $reviews->links() }}
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Fancybox.bind("[data-fancybox]", {
            infinite: false,
            dragToClose: true,
        });
    });
</script>
@endsection
