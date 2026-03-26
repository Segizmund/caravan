<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Админ панель — @yield('title', '')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <link rel="icon" type="image/svg+xml" href="{{asset('img/icons/fav-admin16.svg')}}">

        <link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="grid grid-cols-[280px_auto] gap-5">
            <div>
                <x-admin.sidebar-menu />
            </div>
            <main class="pe-5 pb-5 pt-5">
                @yield('content')
            </main>
        </div>
        <div id="toast-container" class="fixed top-5 left-5 z-[100] flex flex-col gap-3"></div>

        <script src="{{ asset('js/fancybox.umd.js') }}"></script>
    </body>
</html>
<style>
    .toast-item {
        animation: slideIn 0.3s ease forwards, fadeOut 0.5s ease 4.5s forwards;
        min-width: 300px;
    }

    @keyframes slideIn {
        from { transform: translateX(-100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
</style>
<script>
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        
        toast.className = `${bgColor} text-white px-6 py-4 rounded-lg shadow-xl toast-item flex items-center justify-between`;
        toast.innerHTML = `
            <span class="font-medium">${message}</span>
            <button onclick="this.parentElement.remove()" class="ml-4 hover:text-gray-200">&times;</button>
        `;

        container.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 5000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                showToast("{{ $error }}", 'error');
            @endforeach
        @endif
    });
</script>
