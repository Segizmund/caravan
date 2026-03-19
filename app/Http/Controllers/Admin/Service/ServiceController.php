<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected ServiceService $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $services = Service::query()
            ->when($search, fn($q) => $q->where('name', 'like', '%' . $search . '%'))
            ->latest()
            ->get();

        return view('admin.services.index', compact('services', 'search'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $this->validateService($request);

        $this->serviceService->createService(
            $request->only(['name', 'description']),
            $request->file('main_photo'),
            $request->file('photos')
        );

        return redirect()->route('admin.services.index')->with('success', 'Услуга добавлена!');
    }

    public function edit(Service $service)
    {
        $service->load('images');
        return view('admin.services.create', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $this->validateService($request);

        $this->serviceService->updateService(
            $service,
            $request->only(['name', 'description']),
            $request->file('main_photo'),
            $request->file('photos'),
            $request->input('remove_images', [])
        );

        return redirect()->route('admin.services.index')->with('success', 'Услуга обновлена!');
    }

    public function destroy(Service $service)
    {
        $this->serviceService->deleteService($service);
        return redirect()->back()->with('success', 'Услуга удалена!');
    }

    protected function validateService(Request $request)
    {
        return $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'required|string',
            'main_photo'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'photos.*'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'remove_images' => 'nullable|array',
        ],[
            'name.required'        => 'Введите название.',
            'description.required' => 'Заполните описание.',
            
            'main_photo.image'     => 'Файл должен быть изображением.',
            'main_photo.mimes'     => 'Допустимые форматы: JPEG, PNG, JPG, WEBP.',
            'main_photo.max'       => 'Главное фото слишком большое (макс. 5 МБ).',
            
            'photos.*.image'       => 'Один из файлов в галерее не является изображением.',
            'photos.*.mimes'       => 'В галерее разрешены только JPEG, PNG, JPG, WEBP.',
            'photos.*.max'         => 'Фото в галерее превышает лимит 5 МБ.',
        ]);
    }
}