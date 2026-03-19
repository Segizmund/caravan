@props(['model'])

<div class="mt-12 flex flex-col gap-4">
    <h2 class="font-bold text-xl xl:text-2xl">Отзывы</h2>

    <div class="flex flex-col gap-10">
        {{-- Список отзывов --}}
        <div class="flex flex-col gap-4">
            @forelse($model->reviews->where('is_approved', true) as $review)
                <div class="bg-white px-6 py-3 rounded-lg border shadow">
                    <div class="flex flex-col lg:flex-row justify-between gap-3 lg:gap-5">
                        <div class="flex flex-col gap-3 w-full">
                            <div class="flex items-center gap-3">
                                <span class="font-bold text-gray-900">{{ $review->author_name }}</span>
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'fill-gray-200' }}" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-gray-400 text-xs">{{ $review->created_at->format('d.m.Y') }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $review->comment }}</p>
                            </div>
                        </div>
                        <div>
                            @if($review->images->count() > 0)
                                <div class="flex gap-2">
                                    @foreach($review->images as $img)
                                        <a href="{{ asset('storage/' . $img->path) }}" data-fancybox="review-{{ $review->id }}" class="border rounded-lg">
                                            <img src="{{ asset('storage/' . $img->path) }}" class="w-16 h-16 object-cover rounded-lg border border-gray-50 hover:opacity-80 transition">
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-gray-500 bg-gray-50 p-6 rounded-xl border border-dashed border-gray-200">
                    Отзывов пока нет. Будьте первым!
                </div>
            @endforelse
        </div>

        {{-- Форма --}}
        <div class="flex flex-col gap-4">
            <h2 class="font-bold text-xl xl:text-2xl">Оставить отзыв</h2>
            
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                @csrf
                {{-- Автоматическое определение типа модели для полиморфизма --}}
                <input type="hidden" name="reviewable_id" value="{{ $model->id }}">
                <input type="hidden" name="reviewable_type" value="{{ get_class($model) }}">
                <div class="grid lg:grid-cols-[40%_auto] gap-4 lg:gap-8">
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col gap-4">
                            <input type="text" name="author_name" placeholder="Ваше имя" required 
                                class="w-full rounded-lg border-gray-200 p-3 text-sm focus:border-[#FFC059] focus:ring-[#FFC059]">
                            <input type="email" name="email" placeholder="Email" required 
                                class="w-full rounded-lg border-gray-200 p-3 text-sm focus:border-[#FFC059] focus:ring-[#FFC059]">
                        </div>

                        <div class="rating-area">
                            <label class="block text-xs text-gray-500 mb-2 ml-1">Ваша оценка</label>
                            <div class="star-rating flex flex-row-reverse justify-end">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star-{{ $i }}" name="rating" value="{{ $i }}" class="hidden">
                                    <label for="star-{{ $i }}" class="cursor-pointer p-1 transition-colors duration-200">
                                        <svg class="w-8 h-8 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </label>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div>
                        <textarea name="comment" rows="4" placeholder="Текст отзыва..." required 
                          class="w-full min-h-[108px] rounded-lg border-gray-200 p-3 text-sm focus:border-[#FFC059] focus:ring-[#FFC059]"></textarea>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-3">
                    <div class="flex flex-col gap-3">
                        <label class="block text-xs text-gray-500 mb-1 ml-1">Добавить фото (до 3-х)</label>
                        <input type="file" name="images[]" multiple accept="image/*" 
                            class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#FFC059] file:text-white hover:file:bg-[#ffaa21]">
                    </div>
                    <div class="flex justify-end lg:justify-start">
                        <button type="submit" class="w-fit bg-[#FFC059] hover:bg-[#ffaa21] text-white font-bold py-3 px-6 rounded-lg transition shadow-md">
                            Отправить отзыв
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .star-rating label {
        color: #d1d5db !important;
        transition: color 0.2s ease-in-out;
    }

    .star-rating input:checked ~ label {
        color: #FFC059 !important;
    }

    .star-rating:hover label {
        color: #d1d5db !important;
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #FFC059 !important;
    }

    .star-rating input {
        display: none;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (typeof Fancybox !== "undefined") {
            Fancybox.bind("[data-fancybox^='review-']", {
                infinite: false,
                hideScrollbar: false,
                compact: false,
                showClass: "f-fadeIn",
            });
        }
    });
    document.querySelector('input[type="file"]').addEventListener('change', function() {
        const files = this.files;
        const maxSize = 5 * 1024 * 1024;
        
        for (let i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert(`Файл "${files[i].name}" слишком большой! Максимальный размер — 5 МБ.`);
                this.value = "";
                break;
            }
        }
    });
</script>