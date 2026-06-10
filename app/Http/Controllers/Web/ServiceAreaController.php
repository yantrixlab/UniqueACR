<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\ServiceAreaRepository;
use App\Repositories\ServiceRepository;
use Illuminate\View\View;

class ServiceAreaController extends Controller
{
    public function index(ServiceAreaRepository $areaRepository): View
    {
        $zones = $areaRepository->getAllZonesGrouped();

        return view('site.areas.index', compact('zones'));
    }

    public function show(string $slug, ServiceAreaRepository $areaRepository, ServiceRepository $serviceRepository): View
    {
        $area = $areaRepository->getBySlug($slug);
        $services = $serviceRepository->activeWithCategory();

        return view('site.areas.show', compact('area', 'services'));
    }
}
