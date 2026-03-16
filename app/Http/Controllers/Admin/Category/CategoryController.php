<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;
    
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::query()
            ->when($search, fn($q) => $q->where('name', 'like', '%' . $search . '%'))
            ->latest()
            ->get();

        return view('admin.categories.index', compact('categories', 'search'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validateCategory($request);

        $this->categoryService->createCategory(
            $request->only(['name']), 
            $request->file('main_photo'),
            $request->file('photos')
        );

        return redirect()->route('admin.categories.index')->with('success', 'Категория создана!');
    }

    public function edit(Category $category)
    {
        $category->load('images');
        return view('admin.categories.create', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validateCategory($request);

        $this->categoryService->updateCategory(
            $category,
            $request->only(['name']),
            $request->file('main_photo'),
            $request->file('photos'),
            $request->input('remove_images', [])
        );

        return redirect()->route('admin.categories.index')->with('success', 'Категория обновлена!');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        return redirect()->back()->with('success', 'Категория удалена!');
    }

    protected function validateCategory(Request $request)
    {
        return $request->validate([
            'name'          => 'required|string|max:255|unique:categories,name,' . ($request->category->id ?? 'NULL'),
            'main_photo'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'photos.*'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'remove_images' => 'nullable|array',
        ]);
    }
}