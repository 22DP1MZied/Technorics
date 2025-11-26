@extends('layout')

@section('title', __('messages.all_products') . ' - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">{{ __('messages.all_products') }}</span>
        </div>

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('messages.all_products') }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $products->total() }} {{ __('messages.products') }}</p>
            </div>
        </div>

        <div class="flex gap-8">
            <!-- Filters Sidebar -->
            <div class="w-64 flex-shrink-0">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 sticky top-24">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('messages.filters') }}</h2>
                        @if(request()->hasAny(['category', 'brand', 'min_price', 'max_price', 'in_stock']))
                        <a href="{{ route('store.index') }}" class="text-sm text-red-600 hover:text-red-700">{{ __('messages.clear_all') }}</a>
                        @endif
                    </div>

                    <form action="{{ route('store.index') }}" method="GET" id="filter-form">
                        <!-- Category Filter -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-3">{{ __('messages.category') }}</h3>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                <label class="flex items-center cursor-pointer group">
                                    <input 
                                        type="checkbox" 
                                        name="category[]" 
                                        value="{{ $category->slug }}"
                                        {{ in_array($category->slug, request('category', [])) ? 'checked' : '' }}
                                        onchange="document.getElementById('filter-form').submit()"
                                        class="w-4 h-4 text-emerald-600 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 group-hover:text-emerald-600">
                                        {{ $category->name }} ({{ $category->products_count }})
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-6 pb-6 border-b dark:border-gray-700">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-3">{{ __('messages.price_range') }}</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs text-gray-600 dark:text-gray-400">{{ __('messages.min_price') }}</label>
                                    <input 
                                        type="number" 
                                        name="min_price" 
                                        value="{{ request('min_price') }}"
                                        placeholder="€0"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-600 dark:text-gray-400">{{ __('messages.max_price') }}</label>
                                    <input 
                                        type="number" 
                                        name="max_price" 
                                        value="{{ request('max_price') }}"
                                        placeholder="€10000"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                                </div>
                                <button type="submit" class="w-full bg-emerald-600 text-white py-2 rounded-lg hover:bg-emerald-700 transition text-sm">
                                    {{ __('messages.apply') }}
                                </button>
                            </div>
                        </div>

                        <!-- Brand Filter -->
                        <div class="mb-6 pb-6 border-b dark:border-gray-700">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-3">{{ __('messages.brand') }}</h3>
                            <div class="space-y-2 max-h-48 overflow-y-auto">
                                @foreach($brands as $brand)
                                <label class="flex items-center cursor-pointer group">
                                    <input 
                                        type="checkbox" 
                                        name="brand[]" 
                                        value="{{ $brand }}"
                                        {{ in_array($brand, request('brand', [])) ? 'checked' : '' }}
                                        onchange="document.getElementById('filter-form').submit()"
                                        class="w-4 h-4 text-emerald-600 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 group-hover:text-emerald-600">
                                        {{ $brand }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Stock Filter -->
                        <div class="mb-6 pb-6 border-b dark:border-gray-700">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-3">{{ __('messages.availability') }}</h3>
                            <label class="flex items-center cursor-pointer group">
                                <input 
                                    type="checkbox" 
                                    name="in_stock" 
                                    value="1"
                                    {{ request('in_stock') ? 'checked' : '' }}
                                    onchange="document.getElementById('filter-form').submit()"
                                    class="w-4 h-4 text-emerald-600 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 group-hover:text-emerald-600">
                                    {{ __('messages.in_stock_only') }}
                                </span>
                            </label>
                        </div>

                        <!-- Discount Filter -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-3">{{ __('messages.special_offers') }}</h3>
                            <label class="flex items-center cursor-pointer group">
                                <input 
                                    type="checkbox" 
                                    name="on_sale" 
                                    value="1"
                                    {{ request('on_sale') ? 'checked' : '' }}
                                    onchange="document.getElementById('filter-form').submit()"
                                    class="w-4 h-4 text-emerald-600 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 group-hover:text-emerald-600">
                                    {{ __('messages.on_sale') }}
                                </span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="flex-1">
                <!-- Sort Options -->
                <div class="flex items-center justify-between mb-6">
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('messages.showing') }} {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} {{ __('messages.of') }} {{ $products->total() }}
                    </p>
                    <form action="{{ route('store.index') }}" method="GET" class="flex items-center gap-2">
                        <!-- Preserve filters -->
                        @foreach(request()->except('sort') as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $v)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        
                        <select name="sort" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('messages.newest') }}</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>{{ __('messages.price_low_high') }}</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>{{ __('messages.price_high_low') }}</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('messages.name_a_z') }}</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>{{ __('messages.highest_rated') }}</option>
                        </select>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl transition group overflow-hidden border-2 border-transparent hover:border-emerald-200 dark:hover:border-emerald-600">
                        <div class="relative aspect-square overflow-hidden">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            
                            @if($product->discount_price)
                            <div class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-bold animate-pulse">
                                -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}% {{ __('messages.off') }}
                            </div>
                            @endif

                            <!-- Wishlist Button -->
                            @auth
                            @php
                                $inWishlist = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
                            @endphp
                            <button 
                                onclick="toggleWishlist({{ $product->id }}, this)"
                                class="absolute top-4 right-4 w-10 h-10 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white dark:hover:bg-gray-700 transition shadow-lg"
                                data-in-wishlist="{{ $inWishlist ? 'true' : 'false' }}">
                                <svg class="w-5 h-5 {{ $inWishlist ? 'text-red-500 fill-current' : 'text-gray-600 dark:text-gray-300' }}" fill="{{ $inWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="absolute top-4 right-4 w-10 h-10 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white dark:hover:bg-gray-700 transition shadow-lg">
                                <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </a>
                            @endauth

                            <!-- Compare Button -->
                            <button 
                                onclick="addToCompare({{ $product->id }}, this)"
                                class="compare-btn absolute bottom-4 right-4 w-10 h-10 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white dark:hover:bg-gray-700 transition shadow-lg"
                                title="{{ __('messages.compare') }}">
                                <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </button>
                        </div>

                        <div class="p-4">
                            <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold">{{ $product->category->name }}</span>
                            <h3 class="font-bold text-gray-900 dark:text-white mt-1 mb-2 line-clamp-2">{{ $product->name }}</h3>
                            
                            <div class="flex items-center gap-1 mb-2">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 {{ $i < floor($product->rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                                <span class="text-xs text-gray-600 dark:text-gray-400 ml-1">({{ $product->reviews_count }})</span>
                            </div>

                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    @if($product->discount_price)
                                    <div class="flex items-center gap-2">
                                        <span class="text-xl font-bold text-red-600">€{{ number_format($product->discount_price, 2) }}</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400 line-through">€{{ number_format($product->price, 2) }}</span>
                                    </div>
                                    @else
                                    <span class="text-xl font-bold text-gray-900 dark:text-white">€{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('store.product', $product->slug) }}" class="flex-1 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white text-center py-2 rounded-lg font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                    {{ __('messages.view') }}
                                </a>
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full bg-emerald-600 text-white py-2 rounded-lg font-semibold hover:bg-emerald-700 transition">
                                        {{ __('messages.add_to_cart') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-16">
                        <p class="text-gray-600 dark:text-gray-400 text-lg">{{ __('messages.no_products_found') }}</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleWishlist(productId, button) {
    const isInWishlist = button.getAttribute('data-in-wishlist') === 'true';
    const heartIcon = button.querySelector('svg');
    
    if (isInWishlist) {
        heartIcon.classList.remove('text-red-500', 'fill-current');
        heartIcon.classList.add('text-gray-600', 'dark:text-gray-300');
        heartIcon.setAttribute('fill', 'none');
        button.setAttribute('data-in-wishlist', 'false');
    } else {
        heartIcon.classList.remove('text-gray-600', 'dark:text-gray-300');
        heartIcon.classList.add('text-red-500', 'fill-current');
        heartIcon.setAttribute('fill', 'currentColor');
        button.setAttribute('data-in-wishlist', 'true');
    }
    
    const url = isInWishlist ? `/wishlist/remove-by-product/${productId}` : `/wishlist/add/${productId}`;
    const method = isInWishlist ? 'DELETE' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
        }
    });
}

function addToCompare(productId, button) {
    fetch(`/compare/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            updateCompareCount();
            button.classList.add('bg-blue-600');
            button.querySelector('svg').classList.add('text-white');
        } else {
            showToast(data.message, 'error');
        }
    });
}

function showToast(message, type) {
    const toast = document.createElement('div');
    toast.className = `fixed top-24 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-emerald-600' : 'bg-red-600'
    } text-white font-semibold`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.transition = 'all 0.3s ease';
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

function updateCompareCount() {
    fetch('/compare/count')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('compare-count');
            if (data.count > 0) {
                badge.textContent = data.count;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        });
}
</script>
@endsection
