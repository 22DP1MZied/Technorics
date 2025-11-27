@extends('layout')

@section('title', $product->name . ' - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('store.category', $product->category->slug) }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ $product->category->name }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">{{ $product->name }}</span>
        </div>

        <!-- Product Details -->
        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <!-- Product Image -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-8">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg">
            </div>

            <!-- Product Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-8">
                <span class="text-sm text-emerald-600 dark:text-emerald-400 font-semibold">{{ $product->category->name }}</span>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-2 mb-4">{{ $product->name }}</h1>
                
                <!-- Rating -->
                <div class="flex items-center gap-2 mb-4">
                    <div class="flex items-center gap-1">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 {{ $i < floor($averageRating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-gray-600 dark:text-gray-400">{{ number_format($averageRating, 1) }}/5 ({{ $reviews->count() }} {{ __('messages.reviews') }})</span>
                </div>

                <!-- Price -->
                <div class="mb-6">
                    @if($product->discount_price)
                    <div class="flex items-center gap-3">
                        <span class="text-4xl font-bold text-red-600">€{{ number_format($product->discount_price, 2) }}</span>
                        <span class="text-xl text-gray-500 dark:text-gray-400 line-through">€{{ number_format($product->price, 2) }}</span>
                        <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                            -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                        </span>
                    </div>
                    @else
                    <span class="text-4xl font-bold text-gray-900 dark:text-white">€{{ number_format($product->price, 2) }}</span>
                    @endif
                </div>

                <!-- Stock Status -->
                <div class="mb-6">
                    @if($product->stock > 0)
                    <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                        ✓ {{ __('messages.in_stock') }} ({{ $product->stock }} {{ __('messages.available') }})
                    </span>
                    @else
                    <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        {{ __('messages.out_of_stock') }}
                    </span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.description') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $product->description }}</p>
                </div>

                <!-- Brand -->
                <div class="mb-6">
                    <span class="text-gray-600 dark:text-gray-400">{{ __('messages.brand') }}: </span>
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $product->brand }}</span>
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-emerald-600 text-white py-4 rounded-lg font-bold text-lg hover:bg-emerald-700 transition flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            {{ __('messages.add_to_cart') }}
                        </button>
                    </form>

                    @auth
                    @php
                        $inWishlist = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
                    @endphp
                    <button 
                        onclick="toggleWishlist({{ $product->id }}, this)"
                        class="px-6 py-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition"
                        data-in-wishlist="{{ $inWishlist ? 'true' : 'false' }}">
                        <svg class="w-6 h-6 {{ $inWishlist ? 'text-red-500 fill-current' : 'text-gray-600 dark:text-gray-300' }}" fill="{{ $inWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                    @else
                    <a href="{{ route('login') }}" class="px-6 py-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </a>
                    @endauth

                    <button 
                        onclick="addToCompare({{ $product->id }}, this)"
                        class="px-6 py-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Frequently Bought Together -->
        @if($frequentlyBoughtTogether->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">🛒 Frequently Bought Together</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($frequentlyBoughtTogether as $relatedProduct)
                    @include('components.product-card', ['product' => $relatedProduct])
                @endforeach
            </div>
        </div>
        @endif

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">✨ Similar Products You May Like</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    @include('components.product-card', ['product' => $relatedProduct])
                @endforeach
            </div>
        </div>
        @endif

        <!-- Upgraded Reviews Component -->
        @include('components.product-reviews', ['product' => $product, 'reviews' => $reviews, 'averageRating' => $averageRating])
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
            }
        });
}
</script>
@endsection
