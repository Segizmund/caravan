@extends('layouts.app')
@section('title', $information->title)

@section('description', Str::limit(strip_tags($information->description), 160))

@section('og_image')
    @if($mainImage)
        {{ asset('storage/' . $mainImage->path) }}
    @else
        {{ asset('img/og-img/default-share.webp') }}
    @endif
@endsection

@section('content')
<div class="flex flex-col gap-8">
    <div class="grid grid-cols-1 gap-4">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <a href={{route('information.index')}}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="hover:fill-[#e28c00] hover:scale-105 transition duration-300 ease-linear cursor-pointer" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                    </svg>
                </a>
                <h1 class="text-xl xl:text-2xl font-bold text-gray-900">{{ $information->title }}</h1>
            </div>

            <div>
                <p>
                    {{$information->description}}
                </p>
            </div>
        </div>
    </div>
    {{-- Услуги --}}
    <x-frontend.short-services/>
</div>
@endsection