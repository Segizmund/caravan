@extends('layouts.app')

@section('content')
    {{-- Услуги --}}
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl">Услуги</h2>
            <a href="#" class="flex items-center gap-2 hover:text-[#e28c00] transition duration-300 ease-linear">
                Все услуги
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5"/>
                        <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0z"/>
                    </svg>
                </span>
            </a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($services as $service)
                <a href="#" class="rounded-lg h-[120px] relative overflow-hidden">
                    @if($service->main_image)
                        <img src="{{ asset('storage/' . $service->main_image->path) }}" 
                            alt="{{ $service->name }}" 
                            class="w-full h-full object-cover rounded-lg">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-lg">Нет фото</div>
                    @endif
                    <div class="card-black-glass absolute bottom-0 left-0 w-full py-1.5 flex justify-center">
                        <span class="text-white font-semibold">{{ $service->name }}</span>
                    </div>
                </a>
            @empty
                <div class="col-span-4">
                    <span>В данный момент нет ниодной активной услуги.</span>
                </div>
            @endforelse
        </div>
    </div>
    {{-- Прицепы --}}
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl">Прицепы</h2>
            <a href="#" class="flex items-center gap-2 hover:text-[#e28c00] transition duration-300 ease-linear">
                Все прицепы
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5"/>
                        <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0z"/>
                    </svg>
                </span>
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @forelse ($categories as $category)
                <a href="#" class="rounded-lg h-[150px] xl:h-[200px] 2xl:h-[280px] relative overflow-hidden">
                    @if($category->main_image)
                        <img src="{{ asset('storage/' . $category->main_image->path) }}" 
                            alt="{{ $category->name }}" 
                            class="w-full h-full object-cover rounded-lg">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-lg">Нет фото</div>
                    @endif
                    <div class="card-black-glass absolute bottom-0 left-0 w-full py-6 flex justify-center">
                        <span class="text-white font-semibold">{{ $category->name }}</span>
                    </div>
                </a>
            @empty
                <div class="col-span-4">
                    <span>В данный момент нет прицепов.</span>
                </div>
            @endforelse
        </div>
    </div>
    {{-- О предприятии --}}
    <div class="flex flex-col gap-4">
        <h2 class="font-bold text-2xl">О предприятии</h2>
        <div class="grid lg:grid-cols-[55%_auto] gap-8">
            <div class="flex flex-col gap-5">
                <p>
                    Частное предприятие "Любинский и Компания" существует с 2005 года. Организаторы предприятия на протяжении 10 лет занимались реализацией прицепов практически всех заводов-изготовителей автоприцепов Украины. Научившись на ошибках и учитывая недостатки предшественников, открыли Мелитопольский завод автоприцепов "КАРАВАН" (МЗАП " КАРАВАН").
                </p>
                <p>
                    За спиной нашего предприятия огромнейший опыт в сфере производства, поэтому прицеп " Караван " самый лучший прицеп на сегодняшний день в Украине. Мы не хотим и не будем лить грязь на прицепы других производителей, каждый прицеп по-своему хорош и каждый прицеп рассчитан на всевозможные виды грузов, но с твердой уверенностью гарантируем, что наш прицеп соответствует всем европейским стандартам качества. Мы боремся не за количество, а за качество произведенных прицепов.
                </p>
                <p>
                    На заводе работает только высококвалифицированный персонал, который не спешит заполонить нашу страну "тачками", "брычками", "кравчучками", а изготавливает высококачественные прицепы с отличным дизайном и достойной грузоподъемностью, из толстостенного металла и дорогостоящих комплектующих, как на волговских рессорах, так и на немецких рессорах Фирмы "KNOTT". Прицепы могут комплектоваться опорными колесами, опорными стойками, каркасами, тентами ПВХ, крепежами под запаску, различными видами колес.
                </p>
                <p>
                    Прицеп " Караван " отличается от многих других прицепов своей усиленной рамой, со множественными перемычками, для прочности ровного толстостенного листа на днище, усилителями бортов, обшивкой бортов, усиленной осью, V образным дышлом, мощной площадкой под рессоры. Все прицепы проходят предпокрасочную подготовку (грунтуются), окрашиваются автомобильной алкидной краской. На наших прицепах профессиональная электропроводка, ходовая часть укомплектована ступицей ВАЗ 2108.
                </p>
            </div>
            <div class="flex flex-col gap-8">
                <div>
                    <img class="object-cover h-full w-full rounded-lg" src="{{ asset('storage/frontend/home-page-1.jpg') }}" alt="Караван фото">
                </div>
                <div>
                    <img class="object-cover h-full w-full rounded-lg" src="{{ asset('storage/frontend/home-page-2.jpg') }}" alt="Караван фото">
                </div>
            </div>
        </div>
    </div>
    {{-- О производстве --}}
    <div class="flex flex-col gap-4">
        <h2 class="font-bold text-2xl">О производстве</h2>
        <div class="grid lg:grid-cols-[55%_auto] gap-8 bg-white px-5 py-3 rounded-lg">
            <div class="grid grid-cols-3 md:grid-cols-1 lg:grid-cols-3 gap-4 lg:h-[270px]">
                <div>
                    <img class="object-contain lg:object-cover h-[200px] lg:h-full w-full rounded-lg" src="{{ asset('storage/frontend/home-page-3.jpg') }}" alt="Караван сертификат">
                </div>
                <div>
                    <img class="object-contain lg:object-cover h-[200px] lg:h-full w-full rounded-lg" src="{{ asset('storage/frontend/home-page-4.jpg') }}" alt="Караван сертификат">
                </div>
                <div>
                    <img class="object-contain lg:object-cover h-[200px] lg:h-full w-full rounded-lg" src="{{ asset('storage/frontend/home-page-5.jpg') }}" alt="Караван сертификат">
                </div>
            </div>
            <div>
                <p>
                    Наше производство основано на самых последних разработках в этой сфере. Все детали изготавливаются на станках с высокой точностью. Используются качественные комплектующие немецких фирм "AL-KO" и "KNOTT".
                </p>
                <p>
                    Как ответственный производитель легковых прицепов, мы даем полную гарантию безопасности нашей продукции, которая подтверждается соответствующими сертификатами качества.
                </p>
            </div>
        </div>
        <div class="grid lg:grid-cols-[60%_auto] gap-4 bg-white px-5 py-3 rounded-lg">
            <div>
                <p>
                    Наши лафеты и прицепы успешно продаются по всей территории России и имеют обязательную гарантию.
                </p>
                <p>
                    Мы гордимся качеством продаваемой нами техники, и уверенны, что и вы сможете по достоинству ее оценить!
                </p>
            </div>
            <div>
                <img class="object-cover h-full w-full rounded-lg" src="{{ asset('storage/frontend/home-page-6.jpg') }}" alt="Караван фото">
            </div>
        </div>
    </div>
    {{-- Галерея --}}
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl">Галерея</h2>
            <a href="#" class="flex items-center gap-2 hover:text-[#e28c00] transition duration-300 ease-linear">
                Все фото
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5"/>
                        <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0z"/>
                    </svg>
                </span>
            </a>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($gallery as $item)
                <a href="#" class="rounded-lg h-[180px] xl:h-[200px] 2xl:h-[230px] relative overflow-hidden">
                    <img src="{{ asset('storage/' . $item->path) }}" 
                        alt="Фото из галереи" 
                        class="w-full h-full object-cover rounded-lg">
                </a>
            @empty
                <div class="col-span-4">
                    <span>В данный момент нет ниодной фото в галереи.</span>
                </div>
            @endforelse
        </div>
    </div>
@endsection