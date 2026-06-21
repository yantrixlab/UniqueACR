<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\ServiceAreaRepository;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(ServiceAreaRepository $areaRepository): View
    {
        $areas = $areaRepository->getAll();

        return view('site.pages.about', compact('areas'));
    }

    public function contact(): View
    {
        return view('site.pages.contact');
    }

    public function terms(): View
    {
        return view('site.pages.terms');
    }

    public function privacy(): View
    {
        return view('site.pages.privacy');
    }
}
