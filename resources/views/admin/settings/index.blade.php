@extends('layouts.admin')

@section('content')
<div class="flex flex-col gap-5">
    <div>
        <h2 class="text-xl font-bold">Настройки</h2>
    </div>
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Первый номер телефона (шапка и подвал)</label>
            <input class="w-full mt-1 rounded border-gray-300" type="text" name="first_phone" value="{{ old('first_phone', $settings->first_phone) }}">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Второй номер телефона (подвал)</label>
            <input class="w-full mt-1 rounded border-gray-300" type="text" name="second_phone" value="{{ old('second_phone', $settings->second_phone) }}">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Почта</label>
            <input class="w-full mt-1 rounded border-gray-300" type="email" name="email" value="{{ old('email', $settings->email) }}">
        </div>
        
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
            Сохранить
        </button>
    </form>
</div>
@endsection