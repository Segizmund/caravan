@extends('layouts.app')
@section('title', $trailer->name)

@section('description', Str::limit(strip_tags($trailer->description), 160))

@section('og_image')
    @if($mainImage)
        {{ asset('storage/' . $mainImage->path) }}
    @else
        {{ asset('img/og-img/default-share.webp') }}
    @endif
@endsection

@section('content')
<div class="flex flex-col">
    <div class="grid grid-cols-1 lg:grid-cols-[40%_auto] gap-4 lg:gap-8 mb-10">
        <div class="flex lg:hidden flex-col gap-2">
            <div class="flex items-center gap-3">
                <a href={{route('trailer.index')}}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="hover:fill-[#e28c00] hover:scale-105 transition duration-300 ease-linear cursor-pointer" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                    </svg>
                </a>
                <h1 class="text-xl xl:text-2xl font-bold text-gray-900">{{ $trailer->name }}</h1>
            </div>
            <div class="text-3xl font-bold text-[#e28c00]">
                {{ number_format($trailer->price, 0, '.', ' ') }} ₽
            </div>
        </div>
        
        {{-- Используем наш новый компонент галереи --}}
        <x-frontend.image-gallery 
            :images="$trailer->images" 
            :mainImage="$mainImage" 
            :title="$trailer->name" 
        />

        {{-- Правая колонка: Информация и Цена --}}
        <div class="flex flex-col gap-4">
            <div class="hidden lg:flex items-center gap-3">
                <a href={{route('trailer.index')}}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="hover:fill-[#e28c00] hover:scale-105 transition duration-300 ease-linear cursor-pointer" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                    </svg>
                </a>
                <h1 class="text-xl xl:text-2xl font-bold text-gray-900">{{ $trailer->name }}</h1>
            </div>
            
            <div class="hidden lg:flex text-3xl font-bold text-[#e28c00]">
                {{ number_format($trailer->price, 0, '.', ' ') }} ₽
            </div>

            <div class="bg-white px-6 py-4 rounded-lg shadow-sm border border-gray-100">
                <h3 class="font-semibold mb-4 text-lg border-b pb-2 text-gray-800">Характеристики</h3>
                <dl class="grid grid-cols-1 gap-y-3">
                    @php
                        $specs = [
                            'Длина кузова' => $trailer->length_mm ? $trailer->length_mm . ' мм' : null,
                            'Ширина кузова' => $trailer->width_mm ? $trailer->width_mm . ' мм' : null,
                            'Высота борта' => $trailer->board_height_mm ? $trailer->board_height_mm . ' мм' : null,
                            'Масса неснаряженного прицепа' => $trailer->empty_weight_kg ? $trailer->empty_weight_kg . ' кг' : null,
                            'Максимальная грузоподъемность' => $trailer->max_load_capacity_kg ? $trailer->max_load_capacity_kg . ' кг' : null,
                            'Испытанная грузоподъемность' => $trailer->tested_load_capacity_kg ? $trailer->tested_load_capacity_kg . ' кг' : null,
                            'Дышло' => $trailer->drawbar,
                            'Рессорно-амортизаторная подвеска' => $trailer->suspension,
                            'Сцепное устройство' => $trailer->coupling_device,
                            'Ступица' => $trailer->hub,
                            'Ось' => $trailer->axle,
                            'Днище' => $trailer->floor,
                        ];
                    @endphp

                    @foreach($specs as $label => $value)
                        @if($value && !str_contains(strtolower($value), 'null'))
                            <div class="flex justify-between items-center border-b border-gray-50 pb-1 last:border-0">
                                <dt class="text-gray-500 text-sm">{{ $label }}</dt>
                                <dd class="font-medium text-gray-900 text-right text-sm">{{ $value }}</dd>
                            </div>
                        @endif
                    @endforeach
                </dl>
            </div>

            {{-- Дополнительные опции --}}
            @if(!empty($trailer->additional_features) && count($trailer->additional_features) > 0)
                <div class="bg-white px-6 py-4 rounded-lg shadow-sm border border-gray-100">
                    <h3 class="font-semibold mb-3 text-lg border-b pb-2 text-gray-800">Дополнительные опции</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($trailer->additional_features as $feature)
                            @if($feature)
                                <li class="flex items-center gap-2 text-gray-700 text-sm">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ $feature }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex justify-end mt-4">
                <button class="bg-[#FFC059] hover:bg-[#ffaa21] text-white font-bold py-4 px-10 rounded-lg transition duration-300 w-full md:w-max shadow-md">
                    Связаться с нами
                </button>
            </div>
        </div>
    </div>

    {{-- Услуги --}}
    <x-frontend.short-services/>

    {{-- Универсальный компонент отзывов --}}
    <x-frontend.review-section :model="$trailer" />
</div>
@endsection