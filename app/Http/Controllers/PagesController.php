<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function contact()
    {
        return view('pages.contact');
    }

    public function trackOrder()
    {
        return view('pages.track-order');
    }

    public function returns()
    {
        return view('pages.returns');
    }

    public function shipping()
    {
        return view('pages.shipping');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function careers()
    {
        return view('pages.careers');
    }

    public function press()
    {
        return view('pages.press');
    }

    public function blog()
    {
        return view('pages.blog');
    }
}
