<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('site.pages.about');
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
