@extends('layouts.admin')

@section('content')
    <div>

    </div>
        <div class="flex items-center justify-between">
            <h1>Добро пожаловать в админ панель сайта</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{route('logout')}}"
                        class="bg-[#ff5959] text-white font-semibold py-4 px-8 rounded-lg hover:bg-[#ff2121] transition duration-300 ease-linear"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Выйти из аккаунта') }}
                </a>
            </form>
        </div>
    </div>
@endsection
