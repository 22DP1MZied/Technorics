@extends('layout')

@section('title', 'Technorics - ' . __('messages.premium_electronics'))

@section('content')
<!-- Auto-Sliding Announcements -->
<div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white overflow-hidden">
    <div class="announcement-slider py-3">
        <div class="flex animate-slide">
            <div class="flex-shrink-0 px-8">🎉 {{ __('messages.new_arrivals') }}</div>
            <div class="flex-shrink-0 px-8">🚚 {{ __('messages.free_shipping') }}</div>
            <div class="flex-shrink-0 px-8">💰 {{ __('messages.save_up_to') }}</div>
            <div class="flex-shrink-0 px-8">⚡ {{ __('messages.flash_sale') }}</div>
            <div class="flex-shrink-0 px-8">🎮 {{ __('messages.build_pc') }}</div>
        </div>
    </div>
</div>

<!-- Hero Section with Animation -->
<div class="relative bg-gradient-to-br from-gray-900 via-emerald-900 to-teal-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-teal-500 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h1 class="text-5xl md:text-6xl font-bold animate-fade-in-up">
                    {{ __('messages.premium_electronics') }}
                    <span class="block text-emerald-400">{{ __('messages.for_gamers_creators') }}</span>
                </h1>
                <p class="text-xl text-gray-300 animate-fade-in-up" style="animation-delay: 0.2s;">
                    {{ __('messages.hero_description') }}
                </p>
                <div class="flex gap-4 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <a href="{{ route('store.index') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-lg font-bold text-lg transition transform hover:scale-105">
                        {{ __('messages.shop_now') }}
                    </a>
                    <a href="{{ route('store.deals') }}" class="bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white px-8 py-4 rounded-lg font-bold text-lg transition">
                        {{ __('messages.view_deals') }}
                    </a>
                </div>
            </div>
            <div class="relative animate-fade-in" style="animation-delay: 0.6s;">
                <div class="relative z-10">
                    <img src="https://images.unsplash.com/photo-1593640408182-31c70c8268f5?w=600" alt="Gaming Setup" class="rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Live Stats Counter -->
<div class="bg-white dark:bg-gray-800 py-12 border-b dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-emerald-600 dark:text-emerald-400 counter" data-target="500">0</div>
                <div class="text-gray-600 dark:text-gray-400 mt-2">{{ __('messages.products') }}</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-emerald-600 dark:text-emerald-400 counter" data-target="5000">0</div>
                <div class="text-gray-600 dark:text-gray-400 mt-2">{{ __('messages.happy_customers') }}</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-emerald-600 dark:text-emerald-400 counter" data-target="30">0</div>
                <div class="text-gray-600 dark:text-gray-400 mt-2">{{ __('messages.countries') }}</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-emerald-600 dark:text-emerald-400 counter" data-target="99">0</div>
                <div class="text-gray-600 dark:text-gray-400 mt-2">{{ __('messages.satisfaction') }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Flash Deals with Countdown -->
<div class="bg-gradient-to-r from-red-600 to-pink-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold">⚡ {{ __('messages.flash_deals') }}</h2>
                <p class="text-red-100 mt-2">{{ __('messages.deals_end_soon') }}</p>
            </div>
            <div class="flex gap-4 text-center">
                <div class="bg-white/20 backdrop-blur-sm px-4 py-3 rounded-lg">
                    <div class="text-2xl font-bold" id="hours">00</div>
                    <div class="text-xs">{{ __('messages.hours') }}</div>
                </div>
                <div class="bg-white/20 backdrop-blur-sm px-4 py-3 rounded-lg">
                    <div class="text-2xl font-bold" id="minutes">00</div>
                    <div class="text-xs">{{ __('messages.minutes') }}</div>
                </div>
                <div class="bg-white/20 backdrop-blur-sm px-4 py-3 rounded-lg">
                    <div class="text-2xl font-bold" id="seconds">00</div>
                    <div class="text-xs">{{ __('messages.seconds') }}</div>
                </div>
            </div>
        </div>

        @php
            $flashDeals = \App\Models\Product::whereNotNull('discount_price')
                ->where('is_active', true)
                ->with('category')
                ->inRandomOrder()
                ->limit(4)
                ->get();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($flashDeals as $product)
            <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden hover:shadow-2xl transition group">
                <div class="relative">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-110 transition duration-300">
                    <div class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-bold animate-pulse">
                        -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}% {{ __('messages.off') }}
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">{{ $product->name }}</h3>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-2xl font-bold text-red-600">€{{ number_format($product->discount_price, 2) }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 line-through">€{{ number_format($product->price, 2) }}</span>
                    </div>
                    <a href="{{ route('store.product', $product->slug) }}" class="block w-full bg-red-600 text-white text-center py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                        {{ __('messages.grab_deal') }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Featured Products -->
<div class="bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('messages.featured_products') }}</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ __('messages.handpicked_products') }}</p>
            </div>
            <a href="{{ route('store.index') }}" class="text-emerald-600 dark:text-emerald-400 font-semibold hover:text-emerald-700 dark:hover:text-emerald-300 flex items-center gap-2">
                {{ __('messages.view_all') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl transition group overflow-hidden border-2 border-transparent hover:border-emerald-200 dark:hover:border-emerald-600">
                <div class="relative aspect-square overflow-hidden">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    
                    @if($product->discount_price)
                    <div class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-bold animate-pulse">
                        -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                    </div>
                    @endif

                    @auth
                    @php
                        $inWishlist = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
                    @endphp
                    <button 
                        onclick="toggleWishlist({{ $product->id }}, this)"
                        class="wishlist-btn absolute top-4 right-4 w-10 h-10 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white dark:hover:bg-gray-700 transition shadow-lg"
                        data-product-id="{{ $product->id }}"
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

                    <button 
                        onclick="addToCompare({{ $product->id }}, this)"
                        class="compare-btn absolute bottom-4 right-4 w-10 h-10 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white dark:hover:bg-gray-700 transition shadow-lg"
                        data-product-id="{{ $product->id }}">
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
            @endforeach
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="bg-gray-100 dark:bg-gray-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">{{ __('messages.shop_by_category') }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
            @foreach($categories as $category)
            <a href="{{ route('store.category', $category->slug) }}" class="bg-white dark:bg-gray-700 rounded-xl p-6 text-center hover:shadow-lg transition group">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900 dark:to-teal-900 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                    <span class="text-2xl">🖥️</span>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white text-sm mb-1">{{ $category->name }}</h3>
                <span class="text-xs text-gray-600 dark:text-gray-400">{{ $category->products_count }} {{ __('messages.items') }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Why Choose Us -->
<div class="bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-12 text-center">{{ __('messages.why_choose_us') }}</h2>
        <div class="grid md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.authentic_products') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('messages.authentic_desc') }}</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.fast_shipping') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('messages.fast_shipping_desc') }}</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.best_prices') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('messages.best_prices_desc') }}</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.support_247') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('messages.support_desc') }}</p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes slide {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.animate-slide {
    animation: slide 30s linear infinite;
    width: max-content;
}

.announcement-slider {
    overflow: hidden;
}

.announcement-slider .flex {
    display: flex;
    width: max-content;
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
}

@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

.animate-fade-in {
    animation: fade-in 0.8s ease-out forwards;
}
</style>

<script>
// Counter Animation
function animateCounter() {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const updateCounter = () => {
            current += step;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };
        
        updateCounter();
    });
}

// Countdown Timer
function updateCountdown() {
    const now = new Date();
    const midnight = new Date();
    midnight.setHours(24, 0, 0, 0);
    
    const diff = midnight - now;
    
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
    
    document.getElementById('hours').textContent = String(hours).padStart(2, '0');
    document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
    document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
}

// Wishlist Toggle
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
    
    const url = isInWishlist 
        ? `/wishlist/remove-by-product/${productId}`
        : `/wishlist/add/${productId}`;
    
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
    })
    .catch(error => console.error('Error:', error));
}

// Add to Compare
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
    })
    .catch(error => console.error('Error:', error));
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

// Initialize
window.addEventListener('load', () => {
    animateCounter();
    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>
@endsection
