@extends('layouts.admin')
@section('title', 'Список прицепов')

@section('content')
<div class="flex flex-col gap-5">
    <form action="{{ route('admin.trailers.index') }}" method="GET" class="p-5 bg-white rounded-lg shadow-sm border border-gray-100 flex gap-4 items-end">
        <div class="flex-1">
            <label class="block text-xs font-bold text-gray-500 uppercase">Название</label>
            <input type="text" name="search" value="{{ $search }}" placeholder="Поиск по названию..." 
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-indigo-500">
        </div>

        <div class="w-64">
            <label class="block text-xs font-bold text-gray-500 uppercase">Категория</label>
            <select name="category_id" class="mt-1 w-full rounded border-gray-300 shadow-sm">
                <option value="">Все категории</option>
                @foreach(\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">Найти</button>
        <a href="{{ route('admin.trailers.index') }}" class="text-gray-500 hover:text-gray-700 px-4 py-2 border rounded">Сброс</a>
    </form>
    <div>
        <a class="flex gap-2 items-center group font-semibold"
            href="{{ route('admin.trailers.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="group-hover:text-green-600 group-hover:scale-105 transition duration-300 ease-linear" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
            </svg>
            Добавить новый прицеп
        </a>
    </div>
    @forelse($categories as $category)
        <div>
            <h2 class="text-xl font-bold">{{ $category->name }}</h2>
        </div>
            
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($category->trailers as $trailer)
                <div class="bg-white p-5 border rounded shadow relative group">
                    <form action="{{ route('admin.trailers.destroy', $trailer->id) }}" method="POST" 
                        onsubmit="return confirm('Вы уверены, что хотите удалить этот прицеп?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="absolute cursor-pointer opacity-0 group-hover:opacity-100 -top-5 -right-2.5 bg-white hover:bg-red-700 p-2 rounded-full border transition duration-300 ease-linear group/btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="group-hover/btn:fill-white transition duration-300 ease-linear" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </button>
                    </form>
                    <a href={{route('admin.trailers.edit', $trailer->id)}} class="absolute cursor-pointer opacity-0 group-hover:opacity-100 -top-5 right-10 bg-white hover:bg-green-700 p-2 rounded-full border transition duration-300 ease-linear group/btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="group-hover/btn:fill-white transition duration-300 ease-linear" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                    </a>
                    @if($trailer->main_image)
                        <img src="{{ asset('storage/' . $trailer->main_image->path) }}" 
                            alt="{{ $trailer->name }}" 
                            class="w-full h-[200px] 2xl:h-[300px] object-cover rounded">
                    @else
                        <div class="w-full h-[200px] 2xl:h-[300px] bg-gray-200 flex items-center justify-center rounded">
                            Нет фото
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span>Название: {{ $trailer->name }}</span>
                        <span>Цена: {{ $trailer->price }} ₽</span>
                    </div>
                    <div class="overflow-hidden">

                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="p-10 text-center text-gray-500 border-2 border-dashed rounded-lg">
            @if($search)
                <h3 class="text-lg font-medium">Ничего не найдено</h3>
                <p>По вашему запросу прицепов не обнаружено. Попробуйте сменить категорию или название.</p>
                <a href="{{ route('admin.trailers.index') }}" class="text-indigo-600 hover:underline">Сбросить фильтры</a>
            @else
                <h3 class="text-lg font-medium">Каталог прицепов пуст</h3>
                <p>В системе еще нет созданных прицепов. Нажмите кнопку <a href="{{ route('admin.trailers.create') }}" class="text-indigo-600 hover:underline">«Добавить новый прицеп»</a>, чтобы создать первую.</p>
            @endif
        </div>
    @endforelse
</div>

@endsection