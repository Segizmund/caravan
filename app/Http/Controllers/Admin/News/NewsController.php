<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Models\News;

class NewsController extends Controller
{
    protected NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $news = News::query()
            ->when($search, fn($q) => $q->where('title', 'like', '%' . $search . '%'))
            ->latest()
            ->get();

        return view('admin.news.index', compact('news', 'search'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $this->validateNews($request);

        $this->newsService->createNews(
            $request->only(['title', 'description']),
            $request->file('main_photo'),
            $request->file('photos')
        );

        return redirect()->route('admin.news.index')->with('success', 'Новость добавлена!');
    }

    public function edit(News $news)
    {
        $news->load('images');
        return view('admin.news.create', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $this->validateNews($request);

        $this->newsService->updateNews(
            $news,
            $request->only(['title', 'description']),
            $request->file('main_photo'),
            $request->file('photos'),
            $request->input('remove_images', [])
        );

        return redirect()->route('admin.news.index')->with('success', 'Новость обновлена!');
    }

    public function destroy(News $news)
    {
        $this->newsService->deleteNews($news);
        return redirect()->back()->with('success', 'Новость удалена!');
    }

    protected function validateNews(Request $request)
    {
        return $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'main_photo'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'photos.*'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'remove_images' => 'nullable|array',
        ]);
    }
}