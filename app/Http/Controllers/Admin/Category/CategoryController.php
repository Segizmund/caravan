<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $categoryService;
    
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        $hasSearchQuery = $request->has('search') && !empty($search);

        return view('admin.categories.index', compact('categories', 'search', 'hasSearchQuery'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request, CategoryService $categoryService)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $categoryService->createCategory(
            $request->only(['name']), 
            $request->file('photos')
        );

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно создана!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.create', compact('category'));
    }

    public function update(Request $request, Category $category, CategoryService $categoryService)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'remove_images' => 'nullable|array',
        ]);

        $categoryService->updateCategory(
            $category,
            $request->only(['name']),
            $request->file('photos'),
            $request->input('remove_images', [])
        );

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно обновлена!');
    }

    public function destroy($id, CategoryService $categoryService)
    {
        $category = Category::findOrFail($id);
        
        $categoryService->deleteCategory($category);

        return redirect()->back()->with('success', 'Категория и все её изображения успешно удалены!');
    }
}
