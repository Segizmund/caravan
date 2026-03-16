@extends('layouts.app')

@section('content')
    {{-- Каталог --}}
    <div class="h-full flex flex-col justify-between">
        <div class="flex flex-col gap-4">
            <div>
                <h2 class="font-bold text-2xl">Каталог</h2>
            </div>
            @foreach($categories as $category)
                <div class="flex flex-col gap-6" data-category-id="{{ $category->id }}">
                    <div class="bg-white rounded-lg w-full py-2 px-3 flex justify-between items-center">
                        <h2 class="font-medium">{{ $category->name }}</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8" id="trailers-list-{{ $category->id }}">
                        @include('frontend.partials.trailer-list', ['trailers' => $category->trailers])
                    </div>
                    @if($category->trailers->count() >= 6)
                        <button class="load-more-btn flex items-center gap-2 justify-center hover:text-[#e28c00] transition duration-300 ease-linear group" data-category-id="{{ $category->id }}">
                            Показать ещё
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="group-hover:rotate-90 transition  duration-300 ease-linear" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                            </svg>
                        </button>
                    @endif
                </div>
            @endforeach
        

        </div>
        {{-- 2. Вывод ссылок пагинации для категорий --}}
        <div class="pagination">
            {{ $categories->links() }}
        </div>
    </div>

<script>
document.querySelectorAll('.load-more-btn').forEach(button => {
    button.dataset.page = 1; 

    button.addEventListener('click', function() {
        const categoryId = this.dataset.categoryId;
        let page = parseInt(this.dataset.page) + 1;
        const btn = this;

        fetch(`/trailers/category/${categoryId}/load-more?page=${page}`)
            .then(response => response.text())
            .then(html => {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html.trim();
                
                const newItemsCount = tempDiv.querySelectorAll('.trailer-card').length;

                if (newItemsCount === 0) {
                    btn.style.display = 'none';
                } else {
                    document.getElementById(`trailers-list-${categoryId}`).insertAdjacentHTML('beforeend', html);
                    
                    if (newItemsCount < 6) {
                        btn.style.display = 'none';
                    } else {
                        btn.dataset.page = page;
                    }
                }
            })
            .catch(err => console.error("Ошибка загрузки:", err));
    });
});
</script>
@endsection