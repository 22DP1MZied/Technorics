<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Technorics - Electronics Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <!-- Top Info Bar -->
    <div class="bg-gray-900 dark:bg-gray-950 text-white py-2 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <span>📞 +1 800-123-4567</span>
                <span>✉️ info@technorics.com</span>
            </div>
            <div class="flex items-center gap-4">
                <span>🚚 {{ __('messages.free_shipping') }}</span>
                
                <!-- Language Switcher -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-gray-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                        <span class="uppercase">{{ app()->getLocale() }}</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <!-- Language Dropdown -->
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 z-50"
                         style="display: none;">
                        <a href="{{ route('language.switch', 'en') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 {{ app()->getLocale() == 'en' ? 'bg-emerald-50 dark:bg-gray-700 text-emerald-600' : '' }}">
                            <span class="text-xl">🇬🇧</span>
                            <span class="font-medium">English</span>
                        </a>
                        <a href="{{ route('language.switch', 'lv') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 {{ app()->getLocale() == 'lv' ? 'bg-emerald-50 dark:bg-gray-700 text-emerald-600' : '' }}">
                            <span class="text-xl">🇱🇻</span>
                            <span class="font-medium">Latviešu</span>
                        </a>
                        <a href="{{ route('language.switch', 'ru') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 {{ app()->getLocale() == 'ru' ? 'bg-emerald-50 dark:bg-gray-700 text-emerald-600' : '' }}">
                            <span class="text-xl">🇷🇺</span>
                            <span class="font-medium">Русский</span>
                        </a>
                    </div>
                </div>
                
                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode" class="p-2 rounded-lg hover:bg-gray-800 transition">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-40 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">TR</span>
                    </div>
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">Technorics</span>
                </a>

                <!-- Search Bar -->
                <div class="hidden md:block flex-1 max-w-2xl mx-8">
                    <form action="{{ route('store.search') }}" method="GET" class="relative">
                        <input type="text" name="q" placeholder="{{ __('messages.search_placeholder') }}" class="w-full px-6 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-full focus:border-emerald-600 focus:outline-none">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-emerald-600 text-white px-6 py-2 rounded-full hover:bg-emerald-700 transition">
                            {{ __('messages.search') }}
                        </button>
                    </form>
                </div>

                <!-- Right Icons -->
                <div class="flex items-center gap-4">
                    <!-- Compare Button -->
                    <a href="{{ route('compare.index') }}" class="relative flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition" id="compare-btn">
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span class="hidden lg:block text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('messages.compare') }}</span>
                        <span id="compare-count" class="hidden absolute -top-1 -right-1 bg-blue-600 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center"></span>
                    </a>

                    @auth
                    <!-- Profile Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="hidden lg:block text-sm font-semibold text-gray-700 dark:text-gray-300">{{ auth()->user()->name }}</span>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                {{ __('messages.my_profile') }}
                            </a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                {{ __('messages.my_orders') }}
                            </a>
                            <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                {{ __('messages.wishlist') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-gray-700">
                                    {{ __('messages.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="hidden lg:block text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('messages.login') }}</span>
                    </a>
                    @endauth

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="hidden lg:block text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('messages.cart') }}</span>
                        @auth
                        @php
                            $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->count();
                        @endphp
                        @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                        @endif
                        @endauth
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="border-t dark:border-gray-700">
                <div class="flex items-center justify-center gap-8 py-4">
                    <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-semibold transition">{{ __('messages.home') }}</a>
                    <a href="{{ route('store.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-semibold transition">{{ __('messages.all_products') }}</a>
                    
                    <!-- PC Components Dropdown - FIXED -->
                    <div class="relative group">
                        <button class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-semibold transition flex items-center gap-1">
                            {{ __('messages.pc_components') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu - No gap, appears immediately on hover -->
                        <div class="absolute left-0 top-full w-64 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <a href="{{ route('store.category', 'cpus') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                <span class="font-semibold">CPUs (Processors)</span>
                            </a>
                            <a href="{{ route('store.category', 'gpus') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                <span class="font-semibold">Graphics Cards (GPUs)</span>
                            </a>
                            <a href="{{ route('store.category', 'motherboards') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                <span class="font-semibold">Motherboards</span>
                            </a>
                            <a href="{{ route('store.category', 'ram') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                <span class="font-semibold">RAM (Memory)</span>
                            </a>
                            <a href="{{ route('store.category', 'storage') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                <span class="font-semibold">Storage (SSD/HDD)</span>
                            </a>
                            <a href="{{ route('store.category', 'psus') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                <span class="font-semibold">Power Supplies (PSUs)</span>
                            </a>
                            <a href="{{ route('store.category', 'cases') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                <span class="font-semibold">PC Cases</span>
                            </a>
                            <a href="{{ route('store.category', 'cooling') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 hover:text-emerald-600">
                                <span class="font-semibold">Cooling Systems</span>
                            </a>
                        </div>
                    </div>
                    
                    <a href="{{ route('store.category', 'laptops') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-semibold transition">{{ __('messages.laptops') }}</a>
                    <a href="{{ route('store.category', 'monitors') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-semibold transition">{{ __('messages.monitors') }}</a>
                    <a href="{{ route('store.category', 'keyboards') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-semibold transition">{{ __('messages.keyboards') }}</a>
                    <a href="{{ route('store.category', 'mice') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-semibold transition">{{ __('messages.mice') }}</a>
                    <a href="{{ route('store.category', 'headsets') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-semibold transition">{{ __('messages.headsets') }}</a>
                    <a href="{{ route('store.deals') }}" class="text-red-600 hover:text-red-700 font-semibold transition">🔥 {{ __('messages.deals') }}</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="dark:bg-gray-900">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 dark:bg-gray-950 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold">TR</span>
                        </div>
                        <span class="text-xl font-bold">Technorics</span>
                    </div>
                    <p class="text-gray-400 text-sm">{{ __('messages.company_tagline') }}</p>
                </div>

                <!-- Customer Service -->
                <div>
                    <h3 class="font-bold mb-4">{{ __('messages.customer_service') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('pages.contact') }}" class="hover:text-white">{{ __('messages.contact_us') }}</a></li>
                        <li><a href="{{ route('pages.track-order') }}" class="hover:text-white">{{ __('messages.track_order') }}</a></li>
                        <li><a href="{{ route('pages.returns') }}" class="hover:text-white">{{ __('messages.returns') }}</a></li>
                        <li><a href="{{ route('pages.shipping') }}" class="hover:text-white">{{ __('messages.shipping_info') }}</a></li>
                    </ul>
                </div>

                <!-- About Us -->
                <div>
                    <h3 class="font-bold mb-4">{{ __('messages.about_us') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('pages.about') }}" class="hover:text-white">{{ __('messages.our_story') }}</a></li>
                        <li><a href="{{ route('pages.careers') }}" class="hover:text-white">{{ __('messages.careers') }}</a></li>
                        <li><a href="{{ route('pages.press') }}" class="hover:text-white">{{ __('messages.press') }}</a></li>
                        <li><a href="{{ route('pages.blog') }}" class="hover:text-white">{{ __('messages.blog') }}</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="font-bold mb-4">{{ __('messages.contact') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>📞 +1 (800) 123-4567</li>
                        <li>✉️ info@technorics.com</li>
                        <li>⏰ Mon-Fri 9AM-6PM EST</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2024 {{ __('messages.rights_reserved') }}</p>
            </div>
        </div>
    </footer>

    <!-- AI Assistant Widget -->
    @include('components.ai-assistant')

    <script>
    // Update compare count on page load
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
    
    // Call on page load
    updateCompareCount();
    </script>
</body>
</html>
