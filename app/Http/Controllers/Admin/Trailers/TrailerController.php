<?php

namespace App\Http\Controllers\Admin\Trailers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TrailerService;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Trailer;

class TrailerController extends Controller
{
    protected $trailerService;
    
    public function __construct(TrailerService $trailerService)
    {
        $this->trailerService = $trailerService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        
        $hasSearchQuery = !empty($search) || !empty($categoryId);

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

        if ($hasSearchQuery) {
            $categories = $categories->filter(fn($cat) => $cat->trailers->isNotEmpty());
        }

        return view('admin.trailers.index', compact('categories', 'search', 'categoryId', 'hasSearchQuery'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.trailers.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
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
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'category_id' => 'required|exists:categories,id',
            'additional_features' => 'nullable|array',
            'additional_features.*' => 'nullable|string|max:255',
        ]);

        $this->trailerService->createTrailer(
            $request->except('photos'), 
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
        $validatedData = $request->validate([
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
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'remove_images' => 'nullable|array',
            'additional_features' => 'nullable|array',
            'additional_features.*' => 'nullable|string|max:255',
        ]);

        $this->trailerService->updateTrailer(
            $trailer, 
            $request->except(['photos', 'remove_images']), 
            $request->file('photos'),
            $request->input('remove_images', [])
        );

        return redirect()->route('admin.trailers.index')->with('success', 'Прицеп успешно обновлен!');
    }

    public function destroy($id, TrailerService $trailerService)
    {
        $trailer = Trailer::findOrFail($id);
        
        $trailerService->deleteTrailer($trailer);

        return redirect()->back()->with('success', 'Категория и все её изображения успешно удалены!');
    }
}
