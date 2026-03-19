<?php

namespace App\Http\Controllers\Frontend\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ServiceService;
use App\Models\Service;

class ServiceController extends Controller
{
    protected ServiceService $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        $services = $this->serviceService->getPaginatedServices(12); 

        $breadcrumbs = [
            ['title' => 'Каталог услуг']
        ];
        
        return view('frontend.services.catalog-services', compact('services', 'breadcrumbs'));
    }

    public function show(Service $service)
    {
        $data = $this->serviceService->getServiceDetails($service);

        $data['breadcrumbs'] = [
            ['title' => 'Каталог услуг', 'url' => route('service.index')],
            ['title' => $service->name]
        ];

        return view('frontend.services.show', $data);
    }
    
}
