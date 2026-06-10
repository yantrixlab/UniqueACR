<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\ServiceAreaRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request, ServiceRepository $serviceRepository, ServiceAreaRepository $areaRepository): View
    {
        $segment = $request->string('segment')->toString() ?: null;
        $services = $serviceRepository->activeWithCategory($segment);
        $areas = $areaRepository->getAll();

        return view('site.services.index', compact('services', 'segment', 'areas'));
    }

    public function show(string $slug, ServiceRepository $serviceRepository): View
    {
        $service = $serviceRepository->findActiveBySlug($slug);

        return view('site.services.show', compact('service'));
    }
}
