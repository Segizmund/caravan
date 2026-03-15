<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\NewsService;
use App\Models\News;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $news = News::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        $hasSearchQuery = $request->has('search') && !empty($search);

        return view('admin.news.index', compact('news', 'search', 'hasSearchQuery'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request, NewsService $newsService)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description' => 'required|string',
            'photos.*'    => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $newsService->createNews(
            $request->only(['title', 'description']), 
            $request->file('photos')
        );

        return redirect()->route('admin.news.index')->with('success', 'Новость добавлена!');
    }

    public function edit(News $news)
    {
        $news->load('images');
        return view('admin.news.create', compact('news'));
    }

    public function update(Request $request, News $news, NewsService $newsService)
    {
        \Log::info('Пришедшие ID на удаление:', $request->input('remove_images', []));
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description' => 'required|string',
            'photos.*'    => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'remove_images' => 'nullable|array',
        ]);

        $newsService->updateNews(
            $news,
            $request->only(['title', 'description']),
            $request->file('photos'),
            $request->input('remove_images', [])
        );

        return redirect()->route('admin.news.index')->with('success', 'Новость обновлена!');
    }
    public function destroy($id, NewsService $newsService)
    {
        $news = News::findOrFail($id);
        
        $newsService->deleteNews($news);

        return redirect()->back()->with('success', 'Категория и все её изображения успешно удалены!');
    }
}
