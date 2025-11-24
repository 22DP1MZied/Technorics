<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with featured products
     */
    public function index()
    {
        // Get 8 featured products (you can adjust this logic)
        $featuredProducts = Product::with('category')
            ->where('stock', '>', 0)
            ->orderBy('rating', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('featuredProducts'));
    }
}