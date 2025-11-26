<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')
            ->where('is_active', true);

        // Category Filter
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('category', function($q) use ($request) {
                $q->whereIn('slug', $request->category);
            });
        }

        // Brand Filter
        if ($request->has('brand') && !empty($request->brand)) {
            $query->whereIn('brand', $request->brand);
        }

        // Price Range Filter
        if ($request->filled('min_price')) {
            $query->where(function($q) use ($request) {
                $q->where('price', '>=', $request->min_price)
                  ->orWhere('discount_price', '>=', $request->min_price);
            });
        }

        if ($request->filled('max_price')) {
            $query->where(function($q) use ($request) {
                $q->where('price', '<=', $request->max_price)
                  ->orWhere('discount_price', '<=', $request->max_price);
            });
        }

        // In Stock Filter
        if ($request->has('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // On Sale Filter
        if ($request->has('on_sale')) {
            $query->whereNotNull('discount_price');
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderByRaw('COALESCE(discount_price, price) ASC');
                break;
            case 'price_high':
                $query->orderByRaw('COALESCE(discount_price, price) DESC');
                break;
            case 'name':
                $query->orderBy('name', 'ASC');
                break;
            case 'rating':
                $query->orderBy('rating', 'DESC');
                break;
            default: // newest
                $query->orderBy('created_at', 'DESC');
        }

        $products = $query->paginate(12);

        // Get all categories with product count
        $categories = Category::withCount('products')->get();

        // Get all unique brands
        $brands = Product::where('is_active', true)
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand')
            ->filter();

        return view('store.index', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'reviews.user'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('store.product', compact('product'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $products = Product::with('category')
            ->where('category_id', $category->id)
            ->where('is_active', true)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('store.category', compact('category', 'products'));
    }

    public function deals()
    {
        $products = Product::with('category')
            ->whereNotNull('discount_price')
            ->where('is_active', true)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('store.deals', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $products = Product::with('category')
            ->where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('brand', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('store.search', compact('products', 'query'));
    }
}
