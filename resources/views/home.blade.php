@extends('layout')

@section('title', 'Technorics - Premium Electronics Store')

@section('content')
<!-- Announcement Bar with Auto-Slide -->
<div class="bg-gradient-to-r from-emerald-600 via-teal-600 to-green-600 text-white py-2 overflow-hidden">
    <div class="announcement-slider flex items-center justify-center gap-8">
        <div class="announcement-item whitespace-nowrap">🚚 Free Shipping on Orders Over €100</div>
        <div class="announcement-item whitespace-nowrap">⚡ Flash Sale: Up to 40% Off</div>
        <div class="announcement-item whitespace-nowrap">🎁 Free Gift with Every Purchase</div>
        <div class="announcement-item whitespace-nowrap">💳 Buy Now, Pay Later Available</div>
    </div>
</div>

<!-- Hero Slider with Multiple Banners -->
<section class="bg-gradient-to-br from-gray-50 to-gray-100 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="hero-slider relative">
            <!-- Slide 1 -->
            <div class="hero-slide active grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6 animate-fade-in-up">
                    <span class="inline-block px-4 py-2 bg-red-500 text-white text-sm font-bold rounded-full animate-pulse">
                        🔥 Limited Time Offer
                    </span>
                    <h1 class="text-5xl md:text-7xl font-bold text-gray-900 leading-tight">
                        Winter Sale
                        <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Up to 40% Off</span>
                    </h1>
                    <p class="text-xl text-gray-600">
                        Premium gaming gear at unbeatable prices. Upgrade your setup today!
                    </p>
                    <div class="flex gap-4">
                        <a href="#deals" class="group relative px-8 py-4 bg-emerald-600 text-white rounded-lg font-semibold overflow-hidden transition-all hover:shadow-2xl hover:scale-105">
                            <span class="relative z-10">Shop Now</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-700 to-teal-700 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                        </a>
                        <a href="#featured" class="px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:border-emerald-600 hover:text-emerald-600 transition">
                            Browse Products
                        </a>
                    </div>
                    <!-- Stats Counter -->
                    <div class="grid grid-cols-3 gap-6 pt-6 border-t">
                        <div>
                            <div class="text-3xl font-bold text-emerald-600 counter" data-target="500">0</div>
                            <div class="text-sm text-gray-500">Products</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-emerald-600 counter" data-target="50000">0</div>
                            <div class="text-sm text-gray-500">Happy Customers</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-emerald-600">4.9★</div>
                            <div class="text-sm text-gray-500">Rating</div>
                        </div>
                    </div>
                </div>
                <div class="relative animate-float">
                    <img src="https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?w=800" alt="Gaming Laptop" class="rounded-2xl shadow-2xl">
                    <div class="absolute -bottom-6 -left-6 bg-yellow-400 text-gray-900 px-6 py-4 rounded-xl font-bold text-2xl shadow-xl animate-bounce-slow">
                        Save 40%!
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Category Pills -->
<section class="bg-white py-8 sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 overflow-x-auto pb-2 scrollbar-hide">
            @php
            $quickCategories = [
                ['name' => '💻 Laptops', 'count' => '120+'],
                ['name' => '⌨️ Keyboards', 'count' => '85+'],
                ['name' => '🖱️ Mice', 'count' => '95+'],
                ['name' => '🎧 Headsets', 'count' => '70+'],
                ['name' => '🖥️ Monitors', 'count' => '60+'],
                ['name' => '🪑 Chairs', 'count' => '45+'],
            ];
            @endphp
            @foreach($quickCategories as $cat)
            <a href="#featured" class="flex-shrink-0 px-6 py-3 bg-gray-100 rounded-full hover:bg-emerald-600 hover:text-white transition-all duration-300 group">
                <span class="font-semibold">{{ $cat['name'] }}</span>
                <span class="text-sm ml-2 opacity-75">{{ $cat['count'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Flash Deals Countdown -->
<section id="deals" class="bg-gradient-to-r from-red-500 via-pink-500 to-purple-500 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold text-white mb-4">⚡ Flash Deals - Ends Soon!</h2>
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

        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach($featuredProducts->take(5) as $product)
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2">
                @if($product->discount_price)
                <div class="absolute top-3 left-3 z-10 bg-red-600 text-white text-sm font-bold px-3 py-1 rounded-full animate-pulse">
                    -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                </div>
                @endif

                <button class="absolute top-3 right-3 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:scale-110">
                    <svg class="w-5 h-5 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </button>

                <div class="relative h-48 bg-gray-50 overflow-hidden">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500">
                </div>

                <div class="p-4">
                    <div class="text-xs text-emerald-600 font-semibold mb-1">{{ $product->category->name }}</div>
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 h-10 text-sm">{{ $product->name }}</h3>
                    
                    <div class="flex items-center gap-1 mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < floor($product->rating) ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                        @endfor
                        <span class="text-xs text-gray-500 ml-1">({{ $product->reviews_count }})</span>
                    </div>

                    <div class="mb-3">
                        @if($product->discount_price)
                        <div class="flex items-baseline gap-2">
                            <span class="text-2xl font-bold text-red-600">€{{ number_format($product->discount_price, 2) }}</span>
                            <span class="text-sm text-gray-400 line-through">€{{ number_format($product->price, 2) }}</span>
                        </div>
                        @else
                        <span class="text-2xl font-bold text-gray-900">€{{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>

                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700 transition flex items-center justify-center gap-2 transform active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Add to Cart
                        </button>
                    </form>
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Featured Categories with Hover Effects -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Shop by Category</h2>
            <p class="text-gray-600 text-lg">Find exactly what you need</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @php
            $categories = [
                ['name' => 'Laptops', 'icon' => '💻', 'color' => 'from-emerald-500 to-teal-500'],
                ['name' => 'Keyboards', 'icon' => '⌨️', 'color' => 'from-teal-500 to-cyan-500'],
                ['name' => 'Mice', 'icon' => '🖱️', 'color' => 'from-green-500 to-teal-500'],
                ['name' => 'Headsets', 'icon' => '🎧', 'color' => 'from-orange-500 to-red-500'],
                ['name' => 'Monitors', 'icon' => '🖥️', 'color' => 'from-green-500 to-emerald-500'],
                ['name' => 'Chairs', 'icon' => '🪑', 'color' => 'from-teal-500 to-cyan-500'],
            ];
            @endphp

            @foreach($categories as $category)
            <a href="#featured" class="group relative bg-gradient-to-br {{ $category['color'] }} rounded-2xl p-6 text-center overflow-hidden transform hover:scale-105 transition-all duration-300 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="text-6xl mb-4 transform group-hover:scale-125 group-hover:rotate-12 transition-all duration-300">{{ $category['icon'] }}</div>
                    <h3 class="text-white font-bold text-lg">{{ $category['name'] }}</h3>
                    <p class="text-white/80 text-sm mt-1">Explore →</p>
                </div>
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Grid -->
<section id="featured" class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-2">Featured Products</h2>
                <p class="text-gray-600">Handpicked for you</p>
            </div>
            <div class="flex gap-2">
                <button class="filter-btn active px-6 py-2 bg-emerald-600 text-white rounded-lg font-semibold" data-filter="all">All</button>
                <button class="filter-btn px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300" data-filter="sale">On Sale</button>
                <button class="filter-btn px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300" data-filter="new">New</button>
            </div>
        </div>

        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
            <div class="product-card group bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden {{ $product->discount_price ? 'sale' : '' }}">
                <div class="relative h-64 bg-gray-50 overflow-hidden">
                    @if($product->discount_price)
                    <div class="absolute top-3 left-3 z-10 bg-red-600 text-white text-sm font-bold px-3 py-1 rounded-full">
                        SALE
                    </div>
                    @endif

                    <button class="absolute top-3 right-3 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all hover:scale-110">
                        ❤️
                    </button>

                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500">
                    
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-4 transform translate-y-full group-hover:translate-y-0 transition-transform">
                        <button class="w-full bg-white text-gray-900 py-2 rounded-lg font-semibold hover:bg-gray-100">
                            Quick View
                        </button>
                    </div>
                </div>

                <div class="p-6">
                    <div class="text-xs text-emerald-600 font-semibold mb-2">{{ $product->category->name }}</div>
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 h-12">{{ $product->name }}</h3>
                    
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < floor($product->rating) ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                        @endfor
                        <span class="text-sm text-gray-500 ml-2">({{ $product->rating }})</span>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            @if($product->discount_price)
                            <div class="flex items-baseline gap-2">
                                <span class="text-2xl font-bold text-gray-900">€{{ number_format($product->discount_price, 2) }}</span>
                                <span class="text-sm text-gray-400 line-through">€{{ number_format($product->price, 2) }}</span>
                            </div>
                            @else
                            <span class="text-2xl font-bold text-gray-900">€{{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700 transition transform hover:scale-105 active:scale-95">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="text-center mt-12">
            <a href="{{ route('store.index') }}" class="inline-block px-8 py-4 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition transform hover:scale-105">
                View All Products →
            </a>
        </div>
    </div>
</section>

<!-- Trust Badges -->
<section class="bg-white py-16 border-y">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
            <div class="text-center group hover:scale-105 transition-transform">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 transition">
                    <svg class="w-8 h-8 text-emerald-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">100% Authentic</h3>
                <p class="text-gray-600 text-sm">Genuine products only</p>
            </div>

            <div class="text-center group hover:scale-105 transition-transform">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-600 transition">
                    <svg class="w-8 h-8 text-green-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Fast Shipping</h3>
                <p class="text-gray-600 text-sm">Free on orders €100+</p>
            </div>

            <div class="text-center group hover:scale-105 transition-transform">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-teal-600 transition">
                    <svg class="w-8 h-8 text-teal-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Secure Payment</h3>
                <p class="text-gray-600 text-sm">100% protected</p>
            </div>

            <div class="text-center group hover:scale-105 transition-transform">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-600 transition">
                    <svg class="w-8 h-8 text-orange-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">24/7 Support</h3>
                <p class="text-gray-600 text-sm">Always here to help</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="bg-gradient-to-r from-emerald-600 to-teal-600 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-white mb-4">Get Exclusive Deals</h2>
        <p class="text-emerald-100 text-lg mb-8">Subscribe to our newsletter and get 10% off your first order!</p>
        
        <form class="flex flex-col sm:flex-row gap-4 max-w-xl mx-auto">
            <input type="email" placeholder="Enter your email address" class="flex-1 px-6 py-4 rounded-lg focus:outline-none focus:ring-4 focus:ring-white/50 text-lg">
            <button type="submit" class="px-8 py-4 bg-white text-emerald-600 rounded-lg font-bold hover:bg-gray-100 transition transform hover:scale-105 active:scale-95">
                Subscribe Now
            </button>
        </form>
        
        <p class="text-emerald-100 text-sm mt-4">🔒 We respect your privacy. Unsubscribe anytime.</p>
    </div>
</section>

<style>
@keyframes slide {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.announcement-slider {
    animation: slide 20s linear infinite;
}

.announcement-item {
    padding: 0 2rem;
}

@keyframes fadeInUp {
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
    animation: fadeInUp 0.8s ease-out;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@keyframes bounceSlow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.animate-bounce-slow {
    animation: bounceSlow 2s ease-in-out infinite;
}

.product-card:hover {
    transform: translateY(-8px);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
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

// Counter Animation
function animateCounter() {
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                counter.textContent = target.toLocaleString() + '+';
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    });
}

window.addEventListener('load', animateCounter);

// Filter Buttons
const filterButtons = document.querySelectorAll('.filter-btn');
const productCards = document.querySelectorAll('.product-card');

filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        filterButtons.forEach(b => {
            b.classList.remove('active', 'bg-emerald-600', 'text-white');
            b.classList.add('bg-gray-200', 'text-gray-700');
        });
        btn.classList.add('active', 'bg-emerald-600', 'text-white');
        btn.classList.remove('bg-gray-200', 'text-gray-700');
        
        const filter = btn.getAttribute('data-filter');
        productCards.forEach(card => {
            if (filter === 'all') {
                card.style.display = 'block';
            } else if (filter === 'sale') {
                card.style.display = card.classList.contains('sale') ? 'block' : 'none';
            }
        });
    });
});

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>
@endsection