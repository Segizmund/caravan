@extends('layouts.app')
@section('title', 'Главная')

@section('description', 'МЗАП Караван — ведущий производитель высококачественных легковых прицепов. Усиленные рамы, комплектующие KNOTT и AL-KO. Продажа, гарантия и сервисное обслуживание в Мелитополе.')

@section('og_image', asset('img/og-img/og-trailer-cover.webp'))

@section('content')
    {{-- Услуги --}}
    <x-frontend.short-services/>
    {{-- Прицепы --}}
    <x-frontend.short-categories/>
    {{-- О предприятии --}}
    <div class="flex flex-col gap-4">
        <h2 class="font-bold text-xl xl:text-2xl">О предприятии</h2>
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
                    <img class="object-cover h-full w-full rounded-lg" src="{{ asset('img/homePage/home-page-1.webp') }}" alt="Караван фото">
                </div>
                <div>
                    <img class="object-cover h-full w-full rounded-lg" src="{{ asset('img/homePage/home-page-2.webp') }}" alt="Караван фото">
                </div>
            </div>
        </div>
    </div>
    {{-- О производстве --}}
    <div class="flex flex-col gap-4">
        <h2 class="font-bold text-xl xl:text-2xl">О производстве</h2>
        <div class="grid lg:grid-cols-[55%_auto] gap-8 bg-white px-5 py-3 rounded-lg">
            <div class="grid grid-cols-3 md:grid-cols-1 lg:grid-cols-3 gap-4 lg:h-[270px]">
                <div>
                    <img class="object-contain lg:object-cover h-[200px] lg:h-full w-full rounded-lg" src="{{ asset('img/homePage/home-page-3.webp') }}" alt="Караван сертификат">
                </div>
                <div>
                    <img class="object-contain lg:object-cover h-[200px] lg:h-full w-full rounded-lg" src="{{ asset('img/homePage/home-page-4.webp') }}" alt="Караван сертификат">
                </div>
                <div>
                    <img class="object-contain lg:object-cover h-[200px] lg:h-full w-full rounded-lg" src="{{ asset('img/homePage/home-page-5.webp') }}" alt="Караван сертификат">
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
                <img class="object-cover h-full w-full rounded-lg" src="{{ asset('img/homePage/home-page-6.webp') }}" alt="Караван фото">
            </div>
        </div>
    </div>
    {{-- Галерея --}}
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl xl:text-2xl text-gray-900">Галерея</h2>
            <a href="{{route('gallery.index')}}" class="flex items-center gap-2 text-gray-600 hover:text-[#e28c00] transition duration-300 ease-linear group">
                Все фото
                <span class="group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5"/>
                        <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0z"/>
                    </svg>
                </span>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @forelse ($gallery as $item)
                <a href="{{ asset('storage/' . $item->path) }}" 
                   data-fancybox="main-gallery" 
                   class="group relative h-[180px] xl:h-[200px] 2xl:h-[230px] overflow-hidden rounded-xl bg-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                    
                    {{-- Само изображение --}}
                    <img src="{{ asset('storage/' . $item->path) }}" 
                        alt="Фото МЗАП Караван" 
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    
                    {{-- Слой при наведении (zoom-иконка) --}}
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-xl border-2 border-dashed border-gray-200">
                    <span class="text-gray-400 font-medium">В данный момент фотографий в галерее нет.</span>
                </div>
            @endforelse
        </div>
    </div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof Fancybox !== "undefined") {
            
            Fancybox.bind("[data-fancybox]", {
                infinite: true,
                dragToClose: true,
                compact: false,
                showClass: "f-fadeIn",
                
                l10n: {
                    CLOSE: "Закрыть",
                    NEXT: "Следующий",
                    PREV: "Предыдущий",
                },
            });

        }
    });
</script>
@endsection