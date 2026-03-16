<?php

namespace App\Http\Controllers\Frontend\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ServiceService;

class ServiceController extends Controller
{
    protected ServiceService $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        $services = $this->serviceService->getAllServices(); 
        
        return view('frontend.catalog-services', compact('services'));
    }
}
