@extends('layouts.admin')
@if(isset($category))
    @section('title', $category->name)
@else
    @section('title', 'Добавление новой категории')
@endif

@section('content')
<div class="flex flex-col gap-5">
    <div class="flex items-center gap-2">
        <a href={{route('admin.categories.index')}}>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="hover:fill-blue-500 hover:scale-105 transition duration-300 ease-linear cursor-pointer" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold">
            {{ isset($category) ? 'Редактировать категорию: ' . $category->name : 'Добавить новую категорию' }}
        </h1>
    </div>

    <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($category)) @method('PUT') @endif

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col gap-6">
            @include('admin.partials.image-main-upload', ['model' => $category ?? null])
            <div>
                <label class="block text-sm font-medium text-gray-700">Название категории</label>
                <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="mt-1 w-full rounded-md border-gray-300" required>
            </div>

            @include('admin.partials.image-upload', ['model' => $category ?? null])

            <button type="submit" class="bg-indigo-600 text-white py-3 px-4 rounded-md hover:bg-indigo-700 transition">
                {{ isset($category) ? 'Сохранить категорию' : 'Опубликовать категорию' }}
            </button>
        </div>
    </form>
</div>
@endsection