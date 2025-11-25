<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->paginate(12);
        
        $categories = Category::withCount('products')->get();
        
        return view('store.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();
        
        return view('store.product', compact('product', 'relatedProducts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->paginate(12);
        
        return view('store.category', compact('category', 'products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $products = Product::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('brand', 'like', "%{$query}%");
            })
            ->with('category')
            ->paginate(12);
        
        return view('store.search', compact('products', 'query'));
    }

    public function deals()
    {
        $products = Product::whereNotNull('discount_price')
            ->where('is_active', true)
            ->with('category')
            ->orderByRaw('((price - discount_price) / price) DESC')
            ->paginate(12);

        return view('store.deals', compact('products'));
    }
}
