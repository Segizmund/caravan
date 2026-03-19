<?php

namespace App\Http\Controllers\Frontend\News;

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

    public function index()
    {
        $data = $this->newsService->getAllNews();
        
        $data['breadcrumbs'] = [
            ['title' => 'Каталог объявлений']
        ];
        
        return view('frontend.news.catalog-news', $data);
    }

    public function show(News $news)
    {
        $data = $this->newsService->getNewsDetails($news);

        $data['breadcrumbs'] = [
            ['title' => 'Каталог объявлений', 'url' => route('news.index')],
            ['title' => $news->title]
        ];
        return view('frontend.news.show', $data);
    }
}
