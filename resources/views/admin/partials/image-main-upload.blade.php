@php
    // Ищем текущее главное фото, если модель существует
    $mainImage = $model ? $model->images()->where('is_main', true)->first() : null;
@endphp

<div class="col-span-2 mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Главное фото (Обложка)</label>
    <div class="flex items-center gap-4">
        <div class="h-24 w-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center overflow-hidden bg-gray-50">
            @if($mainImage)
                <img src="{{ asset('storage/' . $mainImage->path) }}" class="h-full w-full object-cover">
            @else
                <span id="placeholder-text" class="text-gray-400 text-xs text-center p-2">Нет фото</span>
            @endif
        </div>
        
        <input type="file" name="main_photo" accept="image/*" class="hidden" id="main-photo-input" onchange="previewMain(this)">
        <label for="main-photo-input" class="cursor-pointer bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
            Выбрать обложку
        </label>
    </div>
</div>

<script>
    function previewMain(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const container = input.parentElement.parentElement.querySelector('.h-24');
            const placeholder = container.querySelector('#placeholder-text');
            
            reader.onload = (e) => {
                // Если есть текст-плейсхолдер, удаляем его
                if (placeholder) placeholder.remove();
                // Вставляем картинку или обновляем существующую
                const img = container.querySelector('img') || document.createElement('img');
                img.src = e.target.result;
                img.className = 'h-full w-full object-cover';
                container.appendChild(img);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>