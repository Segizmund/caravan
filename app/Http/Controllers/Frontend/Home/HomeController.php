<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Frontend\HomeService;
use App\Models\Service;
use App\Models\Trailer;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Image;

class HomeController extends Controller
{
    protected $homeService;
    
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $services = Service::inRandomOrder()->take(4)->get();
        $categories = Category::inRandomOrder()->take(3)->get();
        $gallery = Image::where('imageable_type',Gallery::class)
            ->inRandomOrder()
            ->limit(6)
        ->get();
        return view('frontend.index', compact('services', 'categories', 'gallery'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $this->categoryService->createCategory($validatedData);

        return redirect()->back()->with('success', 'Категория успешно создана!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.create', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
         $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $this->categoryService->updateCategory($category, $validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно обновлена!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        $category->delete();

        return redirect()->back()->with('success', 'Категория успешно удалена!');
    }
}
