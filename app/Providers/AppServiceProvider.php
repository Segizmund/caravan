<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Image;
use App\Models\News;
use App\Models\Setting;
use App\Models\Information;
use App\Models\Service;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.frontend.sidebar', function ($view) {
            $view->with([
                // Новости (3 рандомные)
                'sidebarNews' => News::inRandomOrder()
                    ->limit(3)
                ->get(),

                // Информация (4 рандомные)
                'sidebarInfo' => Information::inRandomOrder()
                    ->limit(4)
                ->get(),
            ]);
        });

        View::composer('*', function ($view) {
            $view->with('settings', Setting::find(1) ?? new Setting());
        });

        View::composer('components.frontend.short-services', function ($view) {
            $view->with([
                'services'   => Service::inRandomOrder()->take(4)->get(),
            ]);
        });

        View::composer('components.frontend.short-categories', function ($view) {
            $view->with([
                'categories' => Category::inRandomOrder()->take(3)->get(),
            ]);
        });

    }
}
