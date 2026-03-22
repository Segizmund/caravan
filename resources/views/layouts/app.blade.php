<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Караван — @yield('title', 'Прицепы в Мелитополе')</title>
        <meta name="description" content="@yield('description', 'Лучшие легковые прицепы, запчасти и сервисное обслуживание. Гарантия качества от производителя.')">

        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="@yield('title', 'Прицепы Караван')">
        <meta property="og:description" content="@yield('description', 'Продажа и сервис прицепов.')">
        <meta property="og:image" content="@yield('og_image', asset('img/og-img/og-trailer-cover.webp'))">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <link rel="icon" type="image/svg+xml" href="{{asset('img/icons/fav16.svg')}}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#fafafa]">
        <x-frontend.header />
        <div class="container mx-auto px-2.5 2xl:px-0 min-h-screen flex flex-col gap-8">
            @if(!Route::is('home') && isset($breadcrumbs))
                <x-breadcrumbs :links="$breadcrumbs" />
            @endif
            <div class="grid grid-cols-1 md:grid-cols-[auto_300px] xl:grid-cols-[auto_363px] gap-5">
                <div class="flex flex-col gap-8">
                    @yield('content')
                </div>
                <div class="md:w-[300px] xl:w-[363px]">
                    <x-frontend.sidebar />
                </div>
            </div>
            <div id="toast-container" class="fixed top-5 left-5 z-[100] flex flex-col gap-3"></div>
        </div>
        <x-frontend.footer />
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

        // Удаляем элемент из DOM после завершения анимации исчезновения (через 5 сек)
        setTimeout(() => {
            toast.remove();
        }, 5000);
    }

    // Обработка данных из Laravel сессии
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
