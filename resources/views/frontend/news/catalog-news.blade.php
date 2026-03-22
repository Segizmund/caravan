@extends('layouts.app')
@section('title', 'Каталог объявлений')

@section('description', 'Свежие новости компании Караван: новые модели прицепов, отчеты с производства, участие в выставках и полезные советы для владельцев легковых прицепов в Мелитополе.')

@section('og_image', asset('img/og-img/og-trailer-cover.webp'))

@section('content')
    <div class="flex flex-col gap-4">
        <div>
            <h1 class="font-bold text-xl xl:text-2xl">Каталог Обновлений</h1>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
            @foreach($news as $item)
                <a href="{{ route('news.show', $item) }}" class="bg-white p-3 rounded-lg flex flex-col gap-4 group">
                    @if($item->main_image)
                        <div>
                            <img class="h-[180px] xl:h-[230px] w-full object-cover rounded-lg" src="{{ asset('storage/' . $item->main_image->path) }}" alt="Объявление - {{ $item->title }}">
                        </div>
                    @else
                        <div class="h-[180px] xl:h-[230px] w-full bg-gray-300 flex items-center justify-center rounded-lg">
                            <span class="text-white">Нет фото.</span>
                        </div>
                    @endif
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2 group-hover:text-[#e28c00] transition duration-300 ease-linear">
                                <span class="font-semibold">{{$item->title}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5"/>
                                    <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0z"/>
                                </svg>
                            </div>
                        </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection