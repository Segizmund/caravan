<header class="bg-white container mx-auto px-2.5 2xl:px-0">
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
                        <a href="{{ route('home.index') }}" 
                        class="font-semibold relative group flex">
                            Каталог прицепов
                            <span class="absolute left-1/2 -translate-x-1/2 bottom-0 block h-[1px] bg-[#ffaa21] w-full transition-transform duration-500 ease-out origin-center 
                                {{ request()->routeIs('home.index') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                            </span>
                        </a>
                        <a href="{{ route('home.index') }}" 
                        class="font-semibold relative group flex">
                            Услуги
                            <span class="absolute left-1/2 -translate-x-1/2 bottom-0 block h-[1px] bg-[#ffaa21] w-full transition-transform duration-500 ease-out origin-center 
                                {{ request()->routeIs('home.index') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                            </span>
                        </a>
                        <a href="{{ route('home.index') }}" 
                        class="font-semibold relative group flex">
                            Контакты
                            <span class="absolute left-1/2 -translate-x-1/2 bottom-0 block h-[1px] bg-[#ffaa21] w-full transition-transform duration-500 ease-out origin-center 
                                {{ request()->routeIs('home.index') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                            </span>
                        </a>
                    </div>
                    <div>
                        <button class="bg-[#FFC059] text-white font-semibold py-4 px-8 rounded-lg hover:bg-[#ffaa21] transition duration-300 ease-linear">
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

<script>
    const icon = document.querySelector('.nav-icon');
const menu = document.querySelector('#header-menu');

icon.addEventListener('click', () => {
    icon.classList.toggle("open");
    
    menu.classList.toggle("translate-x-full");
    
    document.body.classList.toggle("overflow-hidden");
});
</script>