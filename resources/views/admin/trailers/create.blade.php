@extends('layouts.admin')
@if(isset($trailer))
    @section('title', $trailer->name)
@else
    @section('title', 'Добавление нового прицепа')
@endif
@section('content')
<div class="flex flex-col gap-5">
    <div class="flex items-center gap-2">
        <a href={{route('admin.trailers.index')}}>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="hover:fill-blue-500 hover:scale-105 transition duration-300 ease-linear cursor-pointer" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold">
            {{ isset($trailer) ? 'Редактировать прицеп: ' . $trailer->name : 'Добавить новый прицеп' }}
        </h1>
    </div>

    <form action="{{ isset($trailer) ? route('admin.trailers.update', $trailer->id) : route('admin.trailers.store') }}" method="POST" enctype="multipart/form-data" id="trailer-form">
        @csrf
        @if(isset($trailer)) @method('PUT') @endif

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Категория</label>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <select required name="category_id" class="mt-1 w-full rounded border-gray-300">
                            <option value="">Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $trailer->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center">
                        <button type="button" popovertarget="add-category" class="flex gap-2 items-center group">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="fill-green-700 group-hover:fill-green-500 transition duration-300 ease-linear" viewBox="0 0 16 16">
                                 <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                            </svg>
                            Добавить новую категорию
                        </button>
                    </div>
                </div>
            </div>
            @include('admin.partials.image-main-upload', ['model' => $trailer ?? null])
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Название модели</label>
                    <input type="text" name="name" required value="{{ old('name', $trailer->name ?? '') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Цена (₽)</label>
                    <input type="number" required step="0.01" name="price" value="{{ old('price', $trailer->price ?? '') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div class="col-span-2 border-t border-gray-100 pt-4">
                    <h3 class="text-lg font-medium mb-4">Технические характеристики (мм / кг)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 uppercase">Длина (мм)</label>
                            <input type="number" name="length_mm" value="{{ old('length_mm', $trailer->length_mm ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 uppercase">Ширина (мм)</label>
                            <input type="number" name="width_mm" value="{{ old('width_mm', $trailer->width_mm ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 uppercase">Высота борта (мм)</label>
                            <input type="number" name="board_height_mm" value="{{ old('board_height_mm', $trailer->board_height_mm ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 uppercase">Собственный вес (кг)</label>
                            <input type="number" name="empty_weight_kg" value="{{ old('empty_weight_kg', $trailer->empty_weight_kg ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 uppercase">Г/П по паспорту (кг)</label>
                            <input type="number" name="max_load_capacity_kg" value="{{ old('max_load_capacity_kg', $trailer->max_load_capacity_kg ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 uppercase">Испытанная Г/П (кг)</label>
                            <input type="number" name="tested_load_capacity_kg" value="{{ old('tested_load_capacity_kg', $trailer->tested_load_capacity_kg ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                    </div>
                </div>

                <div class="col-span-2 border-t border-gray-100 pt-4">
                    <h3 class="text-lg font-medium mb-4">Комплектация</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Дышло</label>
                            <input type="text" name="drawbar" value="{{ old('drawbar', $trailer->drawbar ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Подвеска</label>
                            <input type="text" name="suspension" value="{{ old('suspension', $trailer->suspension ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Сцепное устройство</label>
                            <input type="text" name="coupling_device" value="{{ old('coupling_device', $trailer->coupling_device ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Ступица</label>
                            <input type="text" name="hub" value="{{ old('hub', $trailer->hub ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Ось</label>
                            <input type="text" name="axle" value="{{ old('axle', $trailer->axle ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Днище</label>
                            <input type="text" name="floor" value="{{ old('floor', $trailer->floor ?? '') }}" class="w-full rounded border-gray-300">
                        </div>
                    </div>
                </div>
                <div class="col-span-2 border-t border-gray-100 pt-4">
                    <h3 class="text-lg font-medium mb-4">Дополнительные опции (свои)</h3>
                    <div id="features-container" class="flex flex-col gap-3">
                        @foreach(old('additional_features', $trailer->additional_features ?? []) as $feature)
                            <div class="flex gap-2">
                                <input type="text" name="additional_features[]" value="{{ $feature }}" class="w-full rounded border-gray-300">
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 px-2">Удалить</button>
                            </div>
                        @endforeach
                        </div>
                    <button type="button" onclick="addFeature()" 
                            class="mt-3 text-sm text-indigo-600 font-medium hover:text-indigo-800">
                        + Добавить опцию
                    </button>
                </div>

                <div class="col-span-2">
                    @include('admin.partials.image-upload', ['model' => $trailer ?? null])
                </div>
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md hover:bg-indigo-700 transition">
                    {{ isset($trailer) ? 'Сохранить изменения' : 'Опубликовать прицеп' }}
                </button>
            </div>
        </div>
    </form>
</div>
<div popover id="add-category" class="transition-discrete starting:open:opacity-0 
            backdrop:bg-black/50 backdrop:backdrop-blur-sm bg-transparent">
    <div class="p-6 rounded-lg shadow-xl border border-gray-200 w-80 bg-white">
        <h2 class="text-lg font-bold mb-4">Новая категория</h2>
    
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Название</label>
                <input type="text" name="name" class="w-full mt-1 rounded border-gray-300" required>
            </div>
            
            <div class="flex justify-end gap-2">
                <button type="button" popovertarget="add-category" popovertargetaction="hide" 
                        class="text-sm text-gray-500 hover:text-gray-700">Отмена</button>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // --- ЛОГИКА ДИНАМИЧЕСКИХ ОПЦИЙ ---
    function addFeature() {
        const container = document.getElementById('features-container');
        const div = document.createElement('div');
        div.className = 'flex gap-2';
        div.innerHTML = `
            <input type="text" name="additional_features[]" placeholder="Например: Усиленная рама" 
                   class="w-full rounded border-gray-300">
            <button type="button" onclick="this.parentElement.remove()" 
                    class="text-red-500 hover:text-red-700 px-2">Удалить</button>
        `;
        container.appendChild(div);
    }
</script>
@endsection