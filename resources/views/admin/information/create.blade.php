@extends('layouts.admin')
@if(isset($information))
    @section('title', $information->title)
@else
    @section('title', 'Добавление нового объявления')
@endif

@section('content')
<div class="flex flex-col gap-5">
    <div class="flex items-center gap-2">
        <a href={{route('admin.information.index')}}>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="hover:fill-blue-500 hover:scale-105 transition duration-300 ease-linear cursor-pointer" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold">
            {{ isset($information) ? 'Редактировать категорию: ' . $information->title : 'Добавить новую категорию' }}
        </h1>
    </div>

    <form action="{{ isset($information) ? route('admin.information.update', $information) : route('admin.information.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($information)) @method('PUT') @endif

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col gap-6">
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Заголовок</label>
                <input type="text" name="title" value="{{ old('name', $information->title ?? '') }}" class="mt-1 w-full rounded-md border-gray-300" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Описание</label>
                <textarea name="description" rows="5" class="mt-1 w-full rounded-md border-gray-300" required>{{ old('description', $information->description ?? '') }}</textarea>
            </div>

            <button type="submit" class="bg-indigo-600 text-white py-3 px-4 rounded-md hover:bg-indigo-700 transition">
                {{ isset($information) ? 'Сохранить категорию' : 'Опубликовать категорию' }}
            </button>
        </div>
    </form>
</div>
@endsection