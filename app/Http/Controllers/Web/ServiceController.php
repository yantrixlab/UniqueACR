<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request, ServiceRepository $serviceRepository): View
    {
        $segment = $request->string('segment')->toString() ?: null;
        $services = $serviceRepository->activeWithCategory($segment);

        return view('site.services.index', compact('services', 'segment'));
    }

    public function show(string $slug, ServiceRepository $serviceRepository): View
    {
        $service = $serviceRepository->findActiveBySlug($slug);

        return view('site.services.show', compact('service'));
    }
}
