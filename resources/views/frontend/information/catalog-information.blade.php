@extends('layouts.app')

@section('content')
    <div class="h-full flex flex-col justify-between">
        <div class="flex flex-col gap-4">
            <div>
                <h2 class="font-bold text-xl xl:text-2xl">Каталог информации</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach($information as $item)
                    <a href="{{ route('information.show', $item) }}" class="bg-white relative p-3 rounded-lg flex flex-col gap-4 group">
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2 group-hover:text-[#e28c00] transition duration-300 ease-linear">
                                <span class="font-semibold">{{$item->title}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="absolute right-2 top-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5"/>
                                    <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="line-clamp-1">{{$item->description}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        {{-- Вывод ссылок пагинации --}}
            <div class="pagination">
                {{ $information->links() }}
            </div>
    </div>
@endsection