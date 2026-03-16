<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin;
use App\Http\Controllers\Frontend;



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Админ панель ---

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // --- Управление прицепами (явно прописываем каждый метод) ---
    Route::get('/trailers', [Admin\Trailers\TrailerController::class, 'index'])->name('trailers.index');
    Route::get('/trailers/create', [Admin\Trailers\TrailerController::class, 'create'])->name('trailers.create');
    Route::post('/trailers', [Admin\Trailers\TrailerController::class, 'store'])->name('trailers.store');
    Route::get('/trailers/{trailer}/edit', [Admin\Trailers\TrailerController::class, 'edit'])->name('trailers.edit');
    Route::put('/trailers/{trailer}', [Admin\Trailers\TrailerController::class, 'update'])->name('trailers.update');
    Route::delete('/trailers/{trailer}', [Admin\Trailers\TrailerController::class, 'destroy'])->name('trailers.destroy');

    // --- Управление услугами ---
    Route::get('/services', [Admin\Service\ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [Admin\Service\ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [Admin\Service\ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [Admin\Service\ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [Admin\Service\ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [Admin\Service\ServiceController::class, 'destroy'])->name('services.destroy');

    // --- Управление опциями ---
    Route::get('/options', [Admin\Trailers\OptionController::class, 'index'])->name('options.index');
    Route::get('/options/create', [Admin\Trailers\OptionController::class, 'create'])->name('options.create');
    Route::post('/options', [Admin\Trailers\OptionController::class, 'store'])->name('options.store');
    
    // --- Управление категориями ---
    Route::get('/categories', [Admin\Category\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [Admin\Category\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [Admin\Category\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [Admin\Category\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [Admin\Category\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [Admin\Category\CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // --- Управление новостями ---
    Route::get('/news', [Admin\News\NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [Admin\News\NewsController::class, 'create'])->name('news.create');
    Route::post('/news/store', [Admin\News\NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{news}/edit', [Admin\News\NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news}', [Admin\News\NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [Admin\News\NewsController::class, 'destroy'])->name('news.destroy');

    // --- Управление галереей ---
    Route::get('/gallery', [Admin\Gallery\GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [Admin\Gallery\GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery/store', [Admin\Gallery\GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{image}', [Admin\Gallery\GalleryController::class, 'destroy'])->name('gallery.destroy');

    // --- Управление информацией ---
    Route::get('/information', [Admin\Information\InformationController::class, 'index'])->name('information.index');
    Route::get('/information/create', [Admin\Information\InformationController::class, 'create'])->name('information.create');
    Route::post('/information/store', [Admin\Information\InformationController::class, 'store'])->name('information.store');
    Route::get('/information/{information}/edit', [Admin\Information\InformationController::class, 'edit'])->name('information.edit');
    Route::put('/information/{information}', [Admin\Information\InformationController::class, 'update'])->name('information.update');
    Route::delete('/information/{information}', [Admin\Information\InformationController::class, 'destroy'])->name('information.destroy');

    // --- Управление настройками ---
    Route::get('/settings', [Admin\Settings\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [Admin\Settings\SettingController::class, 'update'])->name('settings.update');
});

// --- Публичная часть ---

Route::get('/', [Frontend\Home\HomeController::class, 'index'])->name('home.index');
Route::get('/trailers', [Frontend\Trailer\TrailerController::class, 'index'])->name('trailer.index');
Route::get('/services', [Frontend\Service\ServiceController::class, 'index'])->name('service.index');

Route::get('/trailers/category/{categoryId}/load-more', [Frontend\Trailer\TrailerController::class, 'loadMore'])->name('trailers.load-more');

require __DIR__.'/auth.php';
