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
        $query = Product::with('category')->where('is_active', true);

        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('sort')) {
            switch($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);
        $categories = Category::withCount('products')->get();
        
        // Get all unique brands from products
        $brands = Product::where('is_active', true)
            ->select('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand')
            ->filter(); // Remove null values

        return view('store.index', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'reviews.user'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Calculate average rating
        $averageRating = $product->reviews->avg('rating') ?? 0;
        
        // Get all reviews (most recent first)
        $reviews = $product->reviews()->with('user')->latest()->get();

        // Get related products and frequently bought together
        $relatedProducts = $product->getRelatedProducts(4);
        $frequentlyBoughtTogether = $product->getFrequentlyBoughtTogether(4);

        return view('store.product', compact('product', 'reviews', 'averageRating', 'relatedProducts', 'frequentlyBoughtTogether'));
    }

    public function category($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $query = Product::where('category_id', $category->id)
            ->where('is_active', true);

        if ($request->has('sort')) {
            switch($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        $products = $query->paginate(12);
        
        // Get brands for this category
        $brands = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->select('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand')
            ->filter();

        return view('store.category', compact('category', 'products', 'brands'));
    }

    public function deals(Request $request)
    {
        // Get products with discount_price (on sale)
        $query = Product::with('category')
            ->where('is_active', true)
            ->whereNotNull('discount_price')
            ->where('discount_price', '<', DB::raw('price'));

        if ($request->has('sort')) {
            switch($request->sort) {
                case 'price_low':
                    $query->orderBy('discount_price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('discount_price', 'desc');
                    break;
                case 'discount':
                    $query->orderByRaw('((price - discount_price) / price * 100) DESC');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            // Default: sort by biggest discount percentage
            $query->orderByRaw('((price - discount_price) / price * 100) DESC');
        }

        $products = $query->paginate(12);
        $categories = Category::withCount('products')->get();
        
        // Get brands from products on sale
        $brands = Product::where('is_active', true)
            ->whereNotNull('discount_price')
            ->where('discount_price', '<', DB::raw('price'))
            ->select('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand')
            ->filter();

        return view('store.deals', compact('products', 'categories', 'brands'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q', ''); // Get search term
        $searchTerm = $query;
        
        $productsQuery = Product::with('category')
            ->where('is_active', true);

        if ($query) {
            $productsQuery->where(function($q) use ($query) {
                // Search in product name, description, brand
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%')
                  ->orWhere('brand', 'like', '%' . $query . '%')
                  // ALSO search in category name
                  ->orWhereHas('category', function($q2) use ($query) {
                      $q2->where('name', 'like', '%' . $query . '%');
                  });
            });
        }

        $products = $productsQuery->paginate(12);
        $categories = Category::withCount('products')->get();
        
        // Get brands from search results
        $brands = Product::where('is_active', true)
            ->when($query, function($q) use ($query) {
                $q->where(function($q2) use ($query) {
                    $q2->where('name', 'like', '%' . $query . '%')
                       ->orWhere('description', 'like', '%' . $query . '%')
                       ->orWhere('brand', 'like', '%' . $query . '%')
                       ->orWhereHas('category', function($q3) use ($query) {
                           $q3->where('name', 'like', '%' . $query . '%');
                       });
                });
            })
            ->select('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand')
            ->filter();

        return view('store.search', compact('products', 'categories', 'query', 'searchTerm', 'brands'));
    }
}
