@extends('layout')

@section('title', $product->name . ' - Technorics')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('store.index') }}" class="text-gray-600 hover:text-emerald-600">Products</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('store.category', $product->category->slug) }}" class="text-gray-600 hover:text-emerald-600">{{ $product->category->name }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">{{ $product->name }}</span>
        </div>
    </div>
</div>

<!-- Product Details -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid md:grid-cols-2 gap-12 mb-16">
        <!-- Product Image -->
        <div class="space-y-4">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-[500px] object-contain p-8">
            </div>
        </div>

        <!-- Product Info -->
        <div class="space-y-6">
            <!-- Category -->
            <div>
                <a href="{{ route('store.category', $product->category->slug) }}" class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold hover:bg-emerald-200 transition">
                    {{ $product->category->name }}
                </a>
            </div>

            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-900">{{ $product->name }}</h1>

            <!-- Rating -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-1">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 {{ $i < floor($product->rating) ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                    @endfor
                </div>
                <span class="text-gray-600">{{ $product->rating }} ({{ $product->reviews_count }} reviews)</span>
            </div>

            <!-- Price -->
            <div class="border-t border-b py-6">
                @if($product->discount_price)
                <div class="flex items-baseline gap-4">
                    <span class="text-5xl font-bold text-gray-900">€{{ number_format($product->discount_price, 2) }}</span>
                    <span class="text-2xl text-gray-400 line-through">€{{ number_format($product->price, 2) }}</span>
                    <span class="px-3 py-1 bg-red-600 text-white rounded-full text-sm font-bold">
                        Save {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                    </span>
                </div>
                @else
                <span class="text-5xl font-bold text-gray-900">€{{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            <!-- Stock Status -->
            <div class="flex items-center gap-3">
                @if($product->stock > 0)
                    <div class="flex items-center gap-2 text-green-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">In Stock ({{ $product->stock }} available)</span>
                    </div>
                @else
                    <div class="flex items-center gap-2 text-red-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">Out of Stock</span>
                    </div>
                @endif
            </div>

            <!-- Description -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3">Description</h3>
                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
            </div>

            <!-- Brand -->
            @if($product->brand)
            <div class="flex items-center gap-3">
                <span class="text-gray-600">Brand:</span>
                <span class="font-semibold text-gray-900">{{ $product->brand }}</span>
            </div>
            @endif

            <!-- Add to Cart -->
            @if($product->stock > 0)
            <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex items-center gap-4">
                    <label class="text-gray-700 font-semibold">Quantity:</label>
                    <div class="flex items-center border-2 border-gray-300 rounded-lg overflow-hidden">
                        <button type="button" onclick="decrementQty()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-20 text-center border-0 focus:ring-0 font-semibold">
                        <button type="button" onclick="incrementQty()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-emerald-600 text-white py-4 rounded-lg font-bold text-lg hover:bg-emerald-700 transition transform hover:scale-105 active:scale-95 flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Add to Cart
                    </button>
                    <button type="button" class="px-6 py-4 border-2 border-gray-300 rounded-lg hover:border-red-500 hover:text-red-500 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
            @else
            <div class="bg-gray-100 border-2 border-gray-300 rounded-lg p-6 text-center">
                <p class="text-gray-600 font-semibold mb-2">This product is currently out of stock</p>
                <button class="text-emerald-600 font-semibold hover:underline">Notify me when available</button>
            </div>
            @endif

            <!-- Features -->
            <div class="bg-gray-50 rounded-xl p-6 space-y-3">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-gray-700">100% Authentic Product</span>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span class="text-gray-700">Free Shipping on Orders €100+</span>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span class="text-gray-700">30-Day Return Policy</span>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span class="text-gray-700">1 Year Warranty</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="border-t pt-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">You May Also Like</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            <div class="group bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div class="relative h-48 bg-gray-50 overflow-hidden">
                    <a href="{{ route('store.product', $related->slug) }}">
                        <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500">
                    </a>
                </div>
                <div class="p-4">
                    <a href="{{ route('store.product', $related->slug) }}">
                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 hover:text-emerald-600 transition">{{ $related->name }}</h3>
                    </a>
                    <div class="text-xl font-bold text-gray-900">
                        @if($related->discount_price)
                            €{{ number_format($related->discount_price, 2) }}
                        @else
                            €{{ number_format($related->price, 2) }}
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
function incrementQty() {
    const input = document.getElementById('quantity');
    const max = parseInt(input.getAttribute('max'));
    if (parseInt(input.value) < max) {
        input.value = parseInt(input.value) + 1;
    }
}

function decrementQty() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
