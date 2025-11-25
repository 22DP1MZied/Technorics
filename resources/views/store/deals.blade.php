@extends('layout')

@section('title', 'Hot Deals - Technorics')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Deals</span>
        </div>
    </div>
</div>

<!-- Deals Header -->
<div class="bg-gradient-to-r from-red-500 via-pink-500 to-purple-500 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">🔥 Hot Deals</h1>
        <p class="text-red-100 text-lg mb-6">Unbeatable prices on premium products!</p>
        
        <!-- Countdown Timer -->
        <div class="flex items-center justify-center gap-4 text-white">
            <div class="text-center bg-white/20 backdrop-blur-sm px-6 py-4 rounded-xl">
                <div class="text-4xl font-bold" id="hours">23</div>
                <div class="text-sm">Hours</div>
            </div>
            <div class="text-3xl">:</div>
            <div class="text-center bg-white/20 backdrop-blur-sm px-6 py-4 rounded-xl">
                <div class="text-4xl font-bold" id="minutes">59</div>
                <div class="text-sm">Minutes</div>
            </div>
            <div class="text-3xl">:</div>
            <div class="text-center bg-white/20 backdrop-blur-sm px-6 py-4 rounded-xl">
                <div class="text-4xl font-bold" id="seconds">59</div>
                <div class="text-sm">Seconds</div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Filters Sidebar -->
        <div class="lg:w-64 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Filters</h3>
                
                <!-- Discount Range -->
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-900 mb-3">Discount</h4>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="rounded text-red-600">
                            <span>50% or more</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="rounded text-red-600">
                            <span>40% or more</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="rounded text-red-600">
                            <span>30% or more</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="rounded text-red-600">
                            <span>20% or more</span>
                        </label>
                    </div>
                </div>

                <!-- Categories -->
                <div class="mb-6 border-t pt-6">
                    <h4 class="font-semibold text-gray-900 mb-3">Categories</h4>
                    <div class="space-y-2">
                        <a href="{{ route('store.category', 'laptops') }}" class="block text-gray-700 hover:text-emerald-600">Laptops</a>
                        <a href="{{ route('store.category', 'keyboards') }}" class="block text-gray-700 hover:text-emerald-600">Keyboards</a>
                        <a href="{{ route('store.category', 'mice') }}" class="block text-gray-700 hover:text-emerald-600">Mice</a>
                        <a href="{{ route('store.category', 'headsets') }}" class="block text-gray-700 hover:text-emerald-600">Headsets</a>
                        <a href="{{ route('store.category', 'monitors') }}" class="block text-gray-700 hover:text-emerald-600">Monitors</a>
                        <a href="{{ route('store.category', 'chairs') }}" class="block text-gray-700 hover:text-emerald-600">Chairs</a>
                    </div>
                </div>

                <!-- Price Range -->
                <div class="border-t pt-6">
                    <h4 class="font-semibold text-gray-900 mb-3">Price Range</h4>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="rounded text-red-600">
                            <span>Under €50</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="rounded text-red-600">
                            <span>€50 - €100</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="rounded text-red-600">
                            <span>€100 - €200</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="rounded text-red-600">
                            <span>€200+</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="flex-1">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Save Big Today!</h2>
                    <p class="text-gray-600">{{ $products->total() }} amazing deals</p>
                </div>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option>Biggest Discount</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Newest First</option>
                </select>
            </div>

            @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($products as $product)
                <div class="group bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border-2 border-red-100">
                    <div class="relative h-64 bg-gray-50 overflow-hidden">
                        <div class="absolute top-3 left-3 z-10 bg-red-600 text-white text-sm font-bold px-3 py-1 rounded-full animate-pulse">
                            -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}% OFF
                        </div>

                        <a href="{{ route('store.product', $product->slug) }}">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500">
                        </a>

                        @auth
                        <form action="{{ route('wishlist.add', $product) }}" method="POST" class="absolute top-3 right-3 z-10">
                            @csrf
                            <button type="submit" class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all hover:scale-110">
                                <svg class="w-5 h-5 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </form>
                        @endauth
                    </div>

                    <div class="p-5">
                        <div class="text-xs text-red-600 font-semibold mb-2">{{ $product->category->name }}</div>
                        <a href="{{ route('store.product', $product->slug) }}">
                            <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 h-12 hover:text-emerald-600 transition">{{ $product->name }}</h3>
                        </a>
                        
                        <div class="flex items-center gap-1 mb-4">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 {{ $i < floor($product->rating) ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @endfor
                            <span class="text-sm text-gray-500 ml-2">({{ $product->reviews_count }})</span>
                        </div>

                        <div class="mb-4">
                            <div class="flex items-baseline gap-2">
                                <span class="text-2xl font-bold text-red-600">€{{ number_format($product->discount_price, 2) }}</span>
                                <span class="text-sm text-gray-400 line-through">€{{ number_format($product->price, 2) }}</span>
                            </div>
                            <p class="text-sm text-green-600 font-semibold mt-1">Save €{{ number_format($product->price - $product->discount_price, 2) }}</p>
                        </div>

                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition transform hover:scale-105 active:scale-95">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
            @else
            <div class="text-center py-16">
                <p class="text-gray-500 text-lg">No deals available right now</p>
                <a href="{{ route('store.index') }}" class="inline-block mt-6 px-6 py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
                    View All Products
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
// Countdown Timer
function updateCountdown() {
    const now = new Date();
    const tomorrow = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1);
    const diff = tomorrow - now;
    
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
    
    document.getElementById('hours').textContent = String(hours).padStart(2, '0');
    document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
    document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
}

updateCountdown();
setInterval(updateCountdown, 1000);
</script>
@endsection
