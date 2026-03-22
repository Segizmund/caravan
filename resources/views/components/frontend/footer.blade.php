<footer class="mt-20">
    <div class="relative px-2.5 2xl:px-0">
        <img class="absolute left-0 top-0 h-full w-full object-cover object-[97%] sm:object-center sm:object-fit" src="{{ asset('img/homePage/footer-bg.webp') }}" alt="Footer Background">
        <div class="bg-[rgba(0,0,0,0.6)] min-h-full min-w-full pointer-events-none absolute top-0 left-0">
        </div>
        <div class="flex flex-col relative z-10 container mx-auto py-6">
            <div class="flex justify-center mb-14">
                <h2 class="font-bold text-2xl text-white">Собаки лают, ветер дует, а КАРАВАН идет!</h2>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between">
                <div class="flex flex-col gap-8">
                    <h3 class="font-bold text-2xl text-white">Караван</h3>
                    <div class="flex flex-col gap-4">
                        <a class="font-semibold text-white hover:opacity-80 transition duration-300 ease-linear" href="#">Прицепы</a>
                        <a class="font-semibold text-white hover:opacity-80 transition duration-300 ease-linear" href="#">Услуги</a>
                        <a class="font-semibold text-white hover:opacity-80 transition duration-300 ease-linear" href="#">Новости</a>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <h3 class="font-bold text-2xl text-white">Контакты</h3>
                    <div class="flex flex-col gap-4">
                        @if($settings->first_phone)
                        <a class="font-semibold flex items-center gap-2 text-white hover:opacity-80 transition duration-300 ease-linear" href="tel:+7 (990)-000-00-00">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.832 16.568C14.0385 16.6628 14.2712 16.6845 14.4917 16.6294C14.7122 16.5744 14.9073 16.4458 15.045 16.265L15.4 15.8C15.5863 15.5516 15.8279 15.35 16.1056 15.2111C16.3833 15.0723 16.6895 15 17 15H20C20.5304 15 21.0391 15.2107 21.4142 15.5858C21.7893 15.9609 22 16.4696 22 17V20C22 20.5304 21.7893 21.0391 21.4142 21.4142C21.0391 21.7893 20.5304 22 20 22C15.2261 22 10.6477 20.1036 7.27208 16.7279C3.89642 13.3523 2 8.7739 2 4C2 3.46957 2.21071 2.96086 2.58579 2.58579C2.96086 2.21071 3.46957 2 4 2H7C7.53043 2 8.03914 2.21071 8.41421 2.58579C8.78929 2.96086 9 3.46957 9 4V7C9 7.31049 8.92771 7.61672 8.78885 7.89443C8.65 8.17214 8.44839 8.41371 8.2 8.6L7.732 8.951C7.54842 9.09118 7.41902 9.29059 7.36579 9.51535C7.31256 9.74012 7.33878 9.97638 7.44 10.184C8.80668 12.9599 11.0544 15.2048 13.832 16.568Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $settings->first_phone}}
                        </a>
                        @endif
                        @if($settings->second_phone)
                        <a class="font-semibold flex items-center gap-2 text-white hover:opacity-80 transition duration-300 ease-linear" href="tel:+7 (990)-000-00-00">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.832 16.568C14.0385 16.6628 14.2712 16.6845 14.4917 16.6294C14.7122 16.5744 14.9073 16.4458 15.045 16.265L15.4 15.8C15.5863 15.5516 15.8279 15.35 16.1056 15.2111C16.3833 15.0723 16.6895 15 17 15H20C20.5304 15 21.0391 15.2107 21.4142 15.5858C21.7893 15.9609 22 16.4696 22 17V20C22 20.5304 21.7893 21.0391 21.4142 21.4142C21.0391 21.7893 20.5304 22 20 22C15.2261 22 10.6477 20.1036 7.27208 16.7279C3.89642 13.3523 2 8.7739 2 4C2 3.46957 2.21071 2.96086 2.58579 2.58579C2.96086 2.21071 3.46957 2 4 2H7C7.53043 2 8.03914 2.21071 8.41421 2.58579C8.78929 2.96086 9 3.46957 9 4V7C9 7.31049 8.92771 7.61672 8.78885 7.89443C8.65 8.17214 8.44839 8.41371 8.2 8.6L7.732 8.951C7.54842 9.09118 7.41902 9.29059 7.36579 9.51535C7.31256 9.74012 7.33878 9.97638 7.44 10.184C8.80668 12.9599 11.0544 15.2048 13.832 16.568Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $settings->second_phone}}
                        </a>
                        @endif
                        @if($settings->email)
                        <a class="font-semibold flex items-center gap-2 text-white hover:opacity-80 transition duration-300 ease-linear" href="mailto:info@karavan-pricepov.com.ua">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 7L13.009 12.727C12.7039 12.9042 12.3573 12.9976 12.0045 12.9976C11.6517 12.9976 11.3051 12.9042 11 12.727L2 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20 4H4C2.89543 4 2 4.89543 2 6V18C2 19.1046 2.89543 20 4 20H20C21.1046 20 22 19.1046 22 18V6C22 4.89543 21.1046 4 20 4Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $settings->email ?? '' }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4 sm:items-center mt-4">
                <h4 class="font-bold text-white sm:text-center">Выбирая наши прицепы, Вы всегда можете быть уверены в правильности своего решения!</h4>
                <span class="text-white sm:text-center">Свяжитесь с нами и мы поможем Вам подобрать оптимальный вариант Вашего прицепа!</span>
                @if($settings->address)
                    <span class="text-white font-bold">
                        Ищите нас по адресу: {{$settings->address}}
                    </span>
                @endif
            </div>
        </div>
    </div>
</footer>