<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->with('category')
            ->orderBy('rating', 'desc')
            ->get();

        return view('home', compact('featuredProducts'));
    }
}
