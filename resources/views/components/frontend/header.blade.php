<header class="bg-white">
    <div class="container mx-auto px-2.5 2xl:px-0">
        <div class="container mx-auto py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-28 xl:gap-36 w-full">
                    <div>
                        <a href="{{ route('home.index') }}" 
                        class="font-semibold relative group flex text-2xl">
                            Караван
                        </a>
                    </div>
                    <div id="header-menu" class="flex flex-col lg:flex-row gap-3 lg:gap-0 lg:items-center lg:justify-between w-full h-[calc(100vh-72px)] lg:h-auto 
                                                fixed lg:static right-0 top-[72px] z-10 bg-white lg:bg-transparent p-5 lg:p-0 
                                                translate-x-full lg:translate-x-0 transition-transform duration-300 ease-linear">
                        <div class="flex flex-col lg:flex-row lg:items-center gap-3 lg:gap-8">
                            <a href="{{ route('trailer.index') }}" 
                            class="font-semibold relative group flex">
                                Каталог прицепов
                                <span class="absolute left-1/2 -translate-x-1/2 bottom-0 block h-[1px] bg-[#ffaa21] w-full transition-transform duration-500 ease-out origin-center 
                                    {{ request()->routeIs('trailer.index') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                                </span>
                            </a>
                            <a href="{{ route('service.index') }}" 
                            class="font-semibold relative group flex">
                                Услуги
                                <span class="absolute left-1/2 -translate-x-1/2 bottom-0 block h-[1px] bg-[#ffaa21] w-full transition-transform duration-500 ease-out origin-center 
                                    {{ request()->routeIs('service.index') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                                </span>
                            </a>
                            <a href="{{ route('contacts.index') }}" 
                            class="font-semibold relative group flex">
                                Контакты
                                <span class="absolute left-1/2 -translate-x-1/2 bottom-0 block h-[1px] bg-[#ffaa21] w-full transition-transform duration-500 ease-out origin-center 
                                    {{ request()->routeIs('contacts.index') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                                </span>
                            </a>
                        </div>
                        <div class="flex flex-col lg:flex-row lg:items-center gap-3">
                            @auth
                                @if(auth()->user()->isAdmin()) {{-- Или @if(auth()->user()->isAdmin()) --}}
                                    <a href="{{ route('admin.dashboard') }}" 
                                    class="hover:text-[#e28c00] font-semibold transition duration-300 ease-linear flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                                        </svg>
                                        Админ панель
                                    </a>
                                @endif
                            @endauth
                            <button popovertarget="connect-us" class="bg-[#FFC059] text-white font-semibold py-4 px-8 w-fit rounded-lg hover:bg-[#ffaa21] transition duration-300 ease-linear">
                                Задать вопрос
                            </button>
                        </div>
                    </div>
                </div>
                <div class="icon nav-icon lg:hidden">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="relative h-[233px] sm:h-[250px] md:h-[350px] xl:h-[400px] 2xl:h-[500px] mb-8 px-2.5 2xl:px-0">
    <img class="absolute left-0 top-0 h-full w-full object-cover object-[24%] sm:object-center sm:object-fit" src="{{ asset('storage/frontend/header-bg.jpg') }}" alt="Header Background">
    <div class="bg-[rgba(0,0,0,0.2)] min-h-full min-w-full pointer-events-none absolute top-0 left-0">
    </div>
    <div class="relative container mx-auto h-full">
        <div class="pt-5 flex flex-col items-end gap-5 md:gap-16">
            <h2 class="text-white font-bold text-sm sm:text-base  md:text-2xl 2xl:text-3xl uppercase flex flex-col items-end gap-4">Мелитопольский завод автоприцепов <br> <span>Опт и розница</span></h2>
            <span class="text-white font-bold text-sm sm:text-base md:text-2xl 2xl:text-3xl uppercase">телефон: {{ $settings->first_phone ?? '' }}</span>
        </div>
    </div>
</div>
<div popover id="connect-us" class="transition-discrete starting:open:opacity-0 
            backdrop:bg-black/50 backdrop:backdrop-blur-sm bg-transparent w-[80%]">
    <div class="p-6 rounded-lg shadow-xl border border-gray-200 w-full bg-white">
        <div class="flex flex-col gap-4">
            <h2 class="font-bold text-xl">Контакты для связи с нами</h2>
            <div class="flex flex-col gap-4">
                @if($settings->first_phone)
                    <a class="font-semibold flex items-center gap-2 hover:opacity-80 transition duration-300 ease-linear" href="tel:+7 (990)-000-00-00">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                        </svg>
                        <div class="flex items-center gap-1.5">
                            <span class="font-semibold">Телефон:</span>
                            <span class="font-normal">{{$settings->first_phone}}</span>
                        </div>
                    </a>
                @endif
                @if($settings->second_phone)
                    <a class="font-semibold flex items-center gap-2 hover:opacity-80 transition duration-300 ease-linear" href="tel:+7 (990)-000-00-00">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                        </svg>
                        <div class="flex items-center gap-1.5">
                            <span class="font-semibold">Телефон:</span>
                            <span class="font-normal">{{$settings->second_phone}}</span>
                        </div>
                    </a>
                @endif
                @if($settings->email)
                    <a class="font-semibold flex items-center gap-2 hover:opacity-80 transition duration-300 ease-linear" href="mailto:info@karavan-pricepov.com.ua">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                    </svg>
                    <div class="flex items-center gap-1.5">
                        <span class="font-semibold">Почта:</span>
                        <span class="font-normal">{{$settings->email}}</span>
                    </div>
                    </a>
                @endif
                @if($settings->address)
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg>
                        <div class="flex items-center gap-1.5">
                            <span class="font-semibold">Адрес:</span>
                            <span>{{$settings->address}}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    const icon = document.querySelector('.nav-icon');
const menu = document.querySelector('#header-menu');

icon.addEventListener('click', () => {
    icon.classList.toggle("open");
    
    menu.classList.toggle("translate-x-full");
    
    document.body.classList.toggle("overflow-hidden");
});
</script>