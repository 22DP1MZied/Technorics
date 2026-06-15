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
            $categories_filter = is_array($request->category) ? $request->category : [$request->category];
            $query->whereHas('category', function($q) use ($categories_filter) {
                $q->whereIn('slug', $categories_filter);
            });
        }

        if ($request->has('brand') && $request->brand) {
            $brands_filter = is_array($request->brand) ? $request->brand : [$request->brand];
            $query->whereIn('brand', $brands_filter);
        }

        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('in_stock') && $request->in_stock) {
            $query->where('stock', '>', 0);
        }

        if ($request->has('on_sale') && $request->on_sale) {
            $query->whereNotNull('discount_price');
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
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::withCount('products')->get();
        
        $brands = Product::where('is_active', true)
            ->select('brand')
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

        $averageRating = $product->reviews->avg('rating') ?? 0;
        $reviews = $product->reviews()->with('user')->latest()->get();
        $relatedProducts = $product->getRelatedProducts(4);
        $frequentlyBoughtTogether = $product->getFrequentlyBoughtTogether(4);

        return view('store.product', compact('product', 'reviews', 'averageRating', 'relatedProducts', 'frequentlyBoughtTogether'));
    }

    public function category($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $query = Product::where('category_id', $category->id)
            ->where('is_active', true);

        if ($request->has('brand') && $request->brand) {
            $brands_filter = is_array($request->brand) ? $request->brand : [$request->brand];
            $query->whereIn('brand', $brands_filter);
        }

        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('in_stock') && $request->in_stock) {
            $query->where('stock', '>', 0);
        }

        if ($request->has('on_sale') && $request->on_sale) {
            $query->whereNotNull('discount_price');
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
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        $products = $query->paginate(12)->withQueryString();
        
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
        $query = Product::with('category')
            ->where('is_active', true)
            ->whereNotNull('discount_price')
            ->where('discount_price', '<', DB::raw('price'));

        if ($request->has('category') && $request->category) {
            $categories_filter = is_array($request->category) ? $request->category : [$request->category];
            $query->whereHas('category', function($q) use ($categories_filter) {
                $q->whereIn('slug', $categories_filter);
            });
        }

        if ($request->has('brand') && $request->brand) {
            $brands_filter = is_array($request->brand) ? $request->brand : [$request->brand];
            $query->whereIn('brand', $brands_filter);
        }

        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

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
            $query->orderByRaw('((price - discount_price) / price * 100) DESC');
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::withCount('products')->get();
        
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
        $query = $request->input('q', '');
        $searchTerm = $query;

        $from = ['ā','č','ē','ģ','ī','ķ','ļ','ņ','š','ū','ž','Ā','Č','Ē','Ģ','Ī','Ķ','Ļ','Ņ','Š','Ū','Ž'];
        $to   = ['a','c','e','g','i','k','l','n','s','u','z','A','C','E','G','I','K','L','N','S','U','Z'];
        $queryNorm = mb_strtolower(str_replace($from, $to, $query));

        $categoryTranslations = [
            'portatīvie datori' => 'Laptops', 'portatīvais dators' => 'Laptops',
            'portativi datori' => 'Laptops', 'laptop' => 'Laptops', 'dators' => 'Laptops',
            'tastatūras' => 'Keyboards', 'tastatūra' => 'Keyboards',
            'klaviaturas' => 'Keyboards', 'klaviatura' => 'Keyboards',
            'klaviatūras' => 'Keyboards', 'klaviatūra' => 'Keyboards',
            'peles' => 'Mice', 'pele' => 'Mice',
            'austiņas' => 'Headsets', 'austiņa' => 'Headsets',
            'austinas' => 'Headsets', 'austina' => 'Headsets',
            'monitori' => 'Monitors', 'monitors' => 'Monitors',
            'krēsli' => 'Chairs', 'krēsls' => 'Chairs',
            'kresli' => 'Chairs', 'kresls' => 'Chairs',
            'procesori' => 'CPUs (Processors)', 'procesors' => 'CPUs (Processors)', 'cpu' => 'CPUs (Processors)',
            'videokartes' => 'Graphics Cards (GPUs)', 'videokarte' => 'Graphics Cards (GPUs)', 'gpu' => 'Graphics Cards (GPUs)',
            'mātesplates' => 'Motherboards', 'mātesplate' => 'Motherboards',
            'matesplates' => 'Motherboards', 'matesplate' => 'Motherboards',
            'operatīvā atmiņa' => 'RAM (Memory)', 'atmiņa' => 'RAM (Memory)',
            'operativa atmina' => 'RAM (Memory)', 'atmina' => 'RAM (Memory)', 'ram' => 'RAM (Memory)',
            'atmiņas ierīces' => 'Storage (SSD/HDD)', 'ssd' => 'Storage (SSD/HDD)', 'hdd' => 'Storage (SSD/HDD)',
            'barošanas bloki' => 'Power Supplies (PSUs)', 'barosanas bloki' => 'Power Supplies (PSUs)', 'psu' => 'Power Supplies (PSUs)',
            'datoru korpusi' => 'PC Cases', 'korpuss' => 'PC Cases',
            'dzesēšanas sistēmas' => 'Cooling Systems', 'dzesētājs' => 'Cooling Systems',
            'ноутбуки' => 'Laptops', 'клавиатуры' => 'Keyboards',
            'мыши' => 'Mice', 'наушники' => 'Headsets',
            'мониторы' => 'Monitors', 'кресла' => 'Chairs',
            'процессоры' => 'CPUs (Processors)', 'видеокарты' => 'Graphics Cards (GPUs)',
            'материнские платы' => 'Motherboards', 'оперативная память' => 'RAM (Memory)',
            'накопители' => 'Storage (SSD/HDD)', 'блоки питания' => 'Power Supplies (PSUs)',
            'корпуса' => 'PC Cases', 'системы охлаждения' => 'Cooling Systems',
        ];

        $queryLower = mb_strtolower($query);
        $englishQuery = $categoryTranslations[$queryLower] ?? $categoryTranslations[$queryNorm] ?? $query;

        $productsQuery = Product::with('category')
            ->where('is_active', true);

        if ($query) {
            $productsQuery->where(function($q) use ($query, $englishQuery) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%')
                  ->orWhere('brand', 'like', '%' . $query . '%')
                  ->orWhereHas('category', function($q2) use ($query, $englishQuery) {
                      $q2->where('name', 'like', '%' . $query . '%')
                         ->orWhere('name', 'like', '%' . $englishQuery . '%');
                  });
            });
        }

        $products = $productsQuery->paginate(12)->withQueryString();
        $categories = Category::withCount('products')->get();
        
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
