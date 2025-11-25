<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Technorics - Electronics Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Top Info Bar -->
    <div class="bg-gray-900 text-white py-2 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <span>📞 +1 800-123-4567</span>
                <span>✉️ info@technorics.com</span>
            </div>
            <div class="flex items-center gap-4">
                <span>🚚 Free Shipping on Orders Over €100</span>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">TR</span>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">Technorics</span>
                </a>

                <!-- Search Bar -->
                <div class="hidden md:block flex-1 max-w-2xl mx-8">
                    <form action="{{ route('store.search') }}" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Search for products..." class="w-full px-6 py-3 border-2 border-gray-300 rounded-full focus:border-emerald-600 focus:outline-none">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-emerald-600 text-white px-6 py-2 rounded-full hover:bg-emerald-700 transition">
                            Search
                        </button>
                    </form>
                </div>

                <!-- Right Icons -->
                <div class="flex items-center gap-4">
                    @auth
                    <!-- Profile Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="hidden lg:block text-sm font-semibold text-gray-700">{{ auth()->user()->name }}</span>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                My Profile
                            </a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                My Orders
                            </a>
                            <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                Wishlist
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="hidden lg:block text-sm font-semibold text-gray-700">Login</span>
                    </a>
                    @endauth

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="hidden lg:block text-sm font-semibold text-gray-700">Cart</span>
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
            <nav class="border-t">
                <div class="flex items-center justify-center gap-8 py-4">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-emerald-600 font-semibold transition">Home</a>
                    <a href="{{ route('store.index') }}" class="text-gray-700 hover:text-emerald-600 font-semibold transition">All Products</a>
                    
                    <!-- PC Components Dropdown -->
                    <div class="relative dropdown">
                        <button class="text-gray-700 hover:text-emerald-600 font-semibold transition flex items-center gap-1">
                            PC Components
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu hidden absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-xl py-2 z-50">
                            <a href="{{ route('store.category', 'cpus') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                <span class="font-semibold">CPUs (Processors)</span>
                            </a>
                            <a href="{{ route('store.category', 'gpus') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                <span class="font-semibold">Graphics Cards (GPUs)</span>
                            </a>
                            <a href="{{ route('store.category', 'motherboards') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                <span class="font-semibold">Motherboards</span>
                            </a>
                            <a href="{{ route('store.category', 'ram') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                <span class="font-semibold">RAM (Memory)</span>
                            </a>
                            <a href="{{ route('store.category', 'storage') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                <span class="font-semibold">Storage (SSD/HDD)</span>
                            </a>
                            <a href="{{ route('store.category', 'psus') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                <span class="font-semibold">Power Supplies (PSUs)</span>
                            </a>
                            <a href="{{ route('store.category', 'cases') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                <span class="font-semibold">PC Cases</span>
                            </a>
                            <a href="{{ route('store.category', 'cooling') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                <span class="font-semibold">Cooling Systems</span>
                            </a>
                        </div>
                    </div>
                    
                    <a href="{{ route('store.category', 'laptops') }}" class="text-gray-700 hover:text-emerald-600 font-semibold transition">Laptops</a>
                    <a href="{{ route('store.category', 'monitors') }}" class="text-gray-700 hover:text-emerald-600 font-semibold transition">Monitors</a>
                    <a href="{{ route('store.category', 'keyboards') }}" class="text-gray-700 hover:text-emerald-600 font-semibold transition">Keyboards</a>
                    <a href="{{ route('store.category', 'mice') }}" class="text-gray-700 hover:text-emerald-600 font-semibold transition">Mice</a>
                    <a href="{{ route('store.category', 'headsets') }}" class="text-gray-700 hover:text-emerald-600 font-semibold transition">Headsets</a>
                    <a href="{{ route('store.deals') }}" class="text-red-600 hover:text-red-700 font-semibold transition">🔥 Deals</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
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
                    <p class="text-gray-400 text-sm">Your trusted partner for premium electronics and gaming gear.</p>
                </div>

                <!-- Customer Service -->
                <div>
                    <h3 class="font-bold mb-4">Customer Service</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('pages.contact') }}" class="hover:text-white">Contact Us</a></li>
                        <li><a href="{{ route('pages.track-order') }}" class="hover:text-white">Track Order</a></li>
                        <li><a href="{{ route('pages.returns') }}" class="hover:text-white">Returns</a></li>
                        <li><a href="{{ route('pages.shipping') }}" class="hover:text-white">Shipping Info</a></li>
                    </ul>
                </div>

                <!-- About Us -->
                <div>
                    <h3 class="font-bold mb-4">About Us</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('pages.about') }}" class="hover:text-white">Our Story</a></li>
                        <li><a href="{{ route('pages.careers') }}" class="hover:text-white">Careers</a></li>
                        <li><a href="{{ route('pages.press') }}" class="hover:text-white">Press</a></li>
                        <li><a href="{{ route('pages.blog') }}" class="hover:text-white">Blog</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="font-bold mb-4">Contact</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>📞 +1 (800) 123-4567</li>
                        <li>✉️ info@technorics.com</li>
                        <li>⏰ Mon-Fri 9AM-6PM EST</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2024 Technorics Electronics. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- AI Assistant Widget -->
    @include('components.ai-assistant')
</body>
</html>
