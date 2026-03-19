<?php

namespace App\Http\Controllers\Admin\Trailers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Trailer;
use App\Services\TrailerService;
use Illuminate\Http\Request;

class TrailerController extends Controller
{
    protected TrailerService $trailerService;

    // Теперь нам нужен только TrailerService
    public function __construct(TrailerService $trailerService)
    {
        $this->trailerService = $trailerService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $categories = Category::query()
            ->whereHas('trailers', function ($query) use ($search, $categoryId) {
                $query->when($search, fn($q) => $q->where('name', 'like', '%' . $search . '%'))
                      ->when($categoryId, fn($q) => $q->where('category_id', $categoryId));
            })
            ->with(['trailers' => function ($query) use ($search, $categoryId) {
                $query->with(['images', 'options'])
                      ->when($search, fn($q) => $q->where('name', 'like', '%' . $search . '%'))
                      ->when($categoryId, fn($q) => $q->where('category_id', $categoryId));
            }])
            ->get();

        return view('admin.trailers.index', compact('categories', 'search', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.trailers.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validateTrailer($request);

        // Передаем отдельно обложку и галерею
        $this->trailerService->createTrailer(
            $request->except(['main_photo', 'photos']),
            $request->file('main_photo'),
            $request->file('photos')
        );

        return redirect()->route('admin.trailers.index')->with('success', 'Прицеп успешно добавлен!');
    }

    public function edit(Trailer $trailer)
    {
        $categories = Category::all();
        $trailer->load('images');
        return view('admin.trailers.create', compact('trailer', 'categories'));
    }

    public function update(Request $request, Trailer $trailer)
    {
        $this->validateTrailer($request);

        // Передаем отдельно обложку, галерею и массив удаляемых ID
        $this->trailerService->updateTrailer(
            $trailer,
            $request->except(['main_photo', 'photos', 'remove_images']),
            $request->file('main_photo'),
            $request->file('photos'),
            $request->input('remove_images', [])
        );

        return redirect()->route('admin.trailers.index')->with('success', 'Прицеп успешно обновлен!');
    }

    public function destroy(Trailer $trailer)
    {
        $this->trailerService->deleteTrailer($trailer);
        return redirect()->back()->with('success', 'Прицеп удален!');
    }

    /**
     * Вспомогательный метод для валидации (чтобы не дублировать код)
     */
    protected function validateTrailer(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'length_mm' => 'nullable|integer|min:0',
            'width_mm' => 'nullable|integer|min:0',
            'board_height_mm' => 'nullable|integer|min:0',
            'empty_weight_kg' => 'nullable|integer|min:0',
            'max_load_capacity_kg' => 'nullable|integer|min:0',
            'tested_load_capacity_kg' => 'nullable|integer|min:0',
            'drawbar' => 'nullable|string|max:255',
            'suspension' => 'nullable|string|max:255',
            'coupling_device' => 'nullable|string|max:255',
            'hub' => 'nullable|string|max:255',
            'axle' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'main_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'remove_images' => 'nullable|array',
            'additional_features' => 'nullable|array',
            'additional_features.*' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Введите название прицепа.',
            'price.required' => 'Укажите стоимость.',
            'category_id.required' => 'Выберите категорию.',
            
            'main_photo.image' => 'Основное фото должно быть изображением.',
            'main_photo.max' => 'Основное фото слишком большое (макс. 5 МБ).',
            
            'photos.*.image' => 'Файлы в галерее должны быть изображениями.',
            'photos.*.max' => 'Одно из фото в галерее превышает 5 МБ.',
            'photos.*.mimes' => 'Допустимые форматы: JPEG, PNG, JPG, WEBP.',
        ]);
    }
}