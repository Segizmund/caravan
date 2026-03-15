@extends('layouts.admin')

@section('content')

<div class="flex flex-col gap-5">
    <div>
        <a class="flex gap-2 items-center group font-semibold"
            href="{{ route('admin.gallery.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="group-hover:text-green-600 group-hover:scale-105 transition duration-300 ease-linear" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
            </svg>
            Добавить фото
        </a>
    </div>
    <div>
        <h2 class="text-xl font-bold">Список всех фото в галереи</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-5">
        @forelse($images as $item)
            <div class="bg-white p-5 border rounded shadow relative group">
                <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" 
                    onsubmit="return confirm('Вы уверены, что хотите удалить это фото?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="absolute cursor-pointer opacity-0 group-hover:opacity-100 -top-5 -right-2.5 bg-white hover:bg-red-700 p-2 rounded-full border transition duration-300 group/btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="group-hover/btn:fill-white transition" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                    </button>
                </form>

                @if($item->path)
                    <img src="{{ asset('storage/' . $item->path) }}" 
                        alt="Фото галереи" 
                        class="w-full h-[200px] object-cover rounded">
                @else
                    <div class="w-full h-[200px] bg-gray-200 flex items-center justify-center rounded">Нет фото</div>
                @endif
            </div>
        @empty
            <div class="p-10 text-center text-gray-500 col-span-full border-2 border-dashed rounded-lg">
                <h3 class="text-lg font-medium">Список фото пуст</h3>
                <p>Вы еще не добавили ни одной фотографии в галерею. Нажмите кнопку <a href="{{ route('admin.gallery.create') }}" class="text-indigo-600 hover:underline">«Добавить фото»</a>, чтобы добавить первую фотографию.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection