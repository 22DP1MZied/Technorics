<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')
            ->where('is_active', true);

        // Apply filters
        $query = $this->applyFilters($query, $request);

        // Sorting
        $query = $this->applySorting($query, $request);

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

    public function category($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $query = Product::with('category')
            ->where('category_id', $category->id)
            ->where('is_active', true);

        // Apply filters
        $query = $this->applyFilters($query, $request);

        // Sorting
        $query = $this->applySorting($query, $request);

        $products = $query->paginate(12);

        // Get all categories with product count
        $categories = Category::withCount('products')->get();

        // Get unique brands for this category
        $brands = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand')
            ->filter();

        return view('store.category', compact('category', 'products', 'categories', 'brands'));
    }

    public function deals(Request $request)
    {
        $query = Product::with('category')
            ->whereNotNull('discount_price')
            ->where('is_active', true);

        // Apply filters
        $query = $this->applyFilters($query, $request);

        // Sorting
        $query = $this->applySorting($query, $request);

        $products = $query->paginate(12);

        // Get all categories with product count
        $categories = Category::withCount('products')->get();

        // Get all unique brands
        $brands = Product::whereNotNull('discount_price')
            ->where('is_active', true)
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand')
            ->filter();

        return view('store.deals', compact('products', 'categories', 'brands'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return redirect()->route('store.index');
        }

        // Normalize search query
        $searchTerm = strtolower(trim($query));

        $productsQuery = Product::with('category')
            ->where('is_active', true)
            ->where(function($q) use ($searchTerm, $query) {
                // Search in product fields
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(description) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(brand) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(slug) LIKE ?', ["%{$searchTerm}%"])
                  // Search in category name
                  ->orWhereHas('category', function($catQuery) use ($searchTerm) {
                      $catQuery->whereRaw('LOWER(name) LIKE ?', ["%{$searchTerm}%"])
                               ->orWhereRaw('LOWER(slug) LIKE ?', ["%{$searchTerm}%"]);
                  });
            });

        // Apply filters
        $productsQuery = $this->applyFilters($productsQuery, $request);

        // Sorting
        $sort = $request->get('sort', 'relevance');
        if ($sort === 'relevance') {
            // Order by best match (exact matches first, then partial)
            $productsQuery->orderByRaw("CASE 
                WHEN LOWER(name) = ? THEN 1
                WHEN LOWER(name) LIKE ? THEN 2
                WHEN LOWER(brand) LIKE ? THEN 3
                WHEN LOWER(description) LIKE ? THEN 4
                ELSE 5
                END", [$searchTerm, "{$searchTerm}%", "%{$searchTerm}%", "%{$searchTerm}%"]);
        } else {
            $productsQuery = $this->applySorting($productsQuery, $request);
        }

        $products = $productsQuery->paginate(12);

        // Get all categories with product count
        $categories = Category::withCount('products')->get();

        // Get all unique brands from search results
        $brands = Product::where('is_active', true)
            ->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(description) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(brand) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(slug) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereHas('category', function($catQuery) use ($searchTerm) {
                      $catQuery->whereRaw('LOWER(name) LIKE ?', ["%{$searchTerm}%"])
                               ->orWhereRaw('LOWER(slug) LIKE ?', ["%{$searchTerm}%"]);
                  });
            })
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand')
            ->filter();

        return view('store.search', compact('products', 'query', 'categories', 'brands'));
    }

    private function applyFilters($query, $request)
    {
        // Category Filter (for main store page only)
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

        return $query;
    }

    private function applySorting($query, $request)
    {
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

        return $query;
    }
}
