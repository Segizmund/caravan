@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-8">
    {{-- Услуги --}}
    <x-frontend.short-services/>

    <div class="grid grid-cols-1 lg:grid-cols-[40%_auto] gap-4 lg:gap-8">
        
        {{-- Используем наш новый компонент галереи --}}
        <x-frontend.image-gallery 
            :images="$service->images" 
            :mainImage="$mainImage" 
            :title="$service->name" 
        />

        {{-- Правая колонка: Информация и Цена --}}
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <a href={{route('service.index')}}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="hover:fill-[#e28c00] hover:scale-105 transition duration-300 ease-linear cursor-pointer" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                    </svg>
                </a>
                <h1 class="text-xl xl:text-2xl font-bold text-gray-900">{{ $service->name }}</h1>
            </div>

            <div>
                <p>
                    {{$service->description}}
                </p>
            </div>


            <div class="flex justify-end mt-4">
                <button class="bg-[#FFC059] hover:bg-[#ffaa21] text-white font-bold py-4 px-10 rounded-lg transition duration-300 w-full md:w-max shadow-md">
                    Связаться с нами
                </button>
            </div>
        </div>
    </div>
    {{-- Универсальный компонент отзывов --}}
    <x-frontend.review-section :model="$service" />
</div>
@endsection