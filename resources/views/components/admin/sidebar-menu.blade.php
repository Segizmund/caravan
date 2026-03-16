<div class="shadow-md p-5 h-screen bg-gray-100 fixed w-[280px] flex flex-col">
    
    <div class="mb-5 border-b border-blue-200 pb-2 flex-shrink-0">
        <a href="{{route('admin.dashboard')}}" class="flex hover:text-blue-500 hover:scale-105 transition duration-300 ease-linear">Караван - Админ панель</a>
    </div>

    <div class="flex flex-col flex-1 overflow-y-auto pr-2 custom-scrollbar">
        
        <div class="mb-2">
            <a class="p-2 flex w-full hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear" 
               href="{{ route('home.index') }}">Главная страница</a>
        </div>

        <div class="mb-2">
            <a class="p-2 flex w-full hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.settings.index') ? 'bg-blue-500 text-white' : ''}}" 
               href="{{ route('admin.settings.index') }}">Настройки</a>
        </div>

        <div class="flex flex-col gap-2 border-b border-blue-200 py-2">
            <div>
                <a class="p-2 flex w-full hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.trailers.index') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.trailers.index') }}">Каталог прицепов</a>
            </div>
            <div class="border-l border-blue-200 ms-2">
                <a class="p-2 ms-2 flex hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.trailers.create') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.trailers.create') }}">Добавить новый прицеп</a>
            </div>
        </div>

        <div class="flex flex-col gap-2 border-b border-blue-200 py-2">
            <div>
                <a class="p-2 flex w-full hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.services.index') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.services.index') }}">Каталог Услуг</a>
            </div>
            <div class="border-l border-blue-200 ms-2">
                <a class="p-2 ms-2 flex hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.services.create') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.services.create') }}">Добавить новую услугу</a>
            </div>
        </div>

        <div class="flex flex-col gap-2 border-b border-blue-200 py-2">
            <div>
                <a class="p-2 flex w-full hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.categories.index') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.categories.index') }}">Список категорий</a>
            </div>
            <div class="border-l border-blue-200 ms-2">
                <a class="p-2 ms-2 flex hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.categories.create') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.categories.create') }}">Добавить новую категорию</a>
            </div>
        </div>

        <div class="flex flex-col gap-2 border-b border-blue-200 py-2">
            <div>
                <a class="p-2 flex w-full hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.news.index') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.news.index') }}">Список всех новостей</a>
            </div>
            <div class="border-l border-blue-200 ms-2">
                <a class="p-2 ms-2 flex hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.news.create') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.news.create') }}">Добавить новую новость</a>
            </div>
        </div>

        <div class="flex flex-col gap-2 py-2">
            <div>
                <a class="p-2 flex w-full hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.gallery.index') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.gallery.index') }}">Галерея</a>
            </div>
            <div class="border-l border-blue-200 ms-2">
                <a class="p-2 ms-2 flex hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.gallery.create') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.gallery.create') }}">Добавить фото в галерею</a>
            </div>
        </div>

        <div class="flex flex-col gap-2 py-2">
            <div>
                <a class="p-2 flex w-full hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.information.index') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.information.index') }}">Список информации</a>
            </div>
            <div class="border-l border-blue-200 ms-2">
                <a class="p-2 ms-2 flex hover:bg-blue-500 hover:text-white rounded-xl transition duration-300 ease-linear {{request()->routeIs('admin.information.create') ? 'bg-blue-500 text-white' : ''}}" 
                   href="{{ route('admin.information.create') }}">Добавить информацию</a>
            </div>
        </div>

    </div>
</div>