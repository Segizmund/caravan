<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HomeService;
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
        $data = $this->homeService->getHomePageData();
        return view('frontend.index', $data);
    }
}
