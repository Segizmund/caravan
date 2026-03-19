<div class="border-t border-gray-100 pt-4">
    <label class="block text-sm font-medium text-gray-700">Фотографии</label>
    
    <div class="mt-2 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6" id="drop-area">
        <div class="text-center">
            <input type="file" name="photos[]" id="file-input" multiple accept="image/*" class="hidden">
            <label for="file-input" class="cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                <span>Нажмите, чтобы выбрать фото</span>
                <p class="text-xs text-gray-500">PNG, JPG, WEBP до 5MB</p>
            </label>
        </div>
    </div>

    <div id="existing-images-container" class="mt-4 grid grid-cols-3 md:grid-cols-5 gap-4">
        @if(isset($model) && $model->images)
            @foreach($model->images->where('is_main', '!=', 1) as $image)
                <div class="relative group" id="image-row-{{ $image->id }}">
                    <img src="{{ asset('storage/' . $image->path) }}" class="h-24 w-full object-cover rounded-md border">
                    <button type="button" onclick="removeExistingImage({{ $image->id }})" 
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">×</button>
                    <input type="hidden" name="remove_images[]" id="remove-input-{{ $image->id }}" value="{{ $image->id }}" disabled>
                </div>
            @endforeach
        @endif
    </div>

    <div id="preview-container" class="mt-4 grid grid-cols-3 md:grid-cols-5 gap-4"></div>
</div>

<script>
    const fileInput = document.getElementById('file-input');
    const previewContainer = document.getElementById('preview-container');
    let allFiles = [];

    fileInput.addEventListener('change', (e) => {
        const files = Array.from(e.target.files);
        files.forEach(file => {
            allFiles.push(file);
            const reader = new FileReader();
            reader.onload = (event) => {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `<img src="${event.target.result}" class="h-24 w-full object-cover rounded-md border">
                                 <button type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">×</button>`;
                div.querySelector('button').onclick = () => {
                    allFiles = allFiles.filter(f => f !== file);
                    div.remove();
                    updateInput();
                };
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
        updateInput();
    });

    function updateInput() {
        const dataTransfer = new DataTransfer();
        allFiles.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }

    function removeExistingImage(id) {
        const row = document.getElementById('image-row-' + id);
        if (row) {
            row.style.display = 'none';
        }
        
        const input = document.getElementById('remove-input-' + id);
        if (input) {
            input.disabled = false;
        }
    }
</script>