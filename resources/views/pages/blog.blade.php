@extends('layout')

@section('title', 'Blog - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Blog</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold text-gray-900 mb-6">Technorics Blog</h1>
        <p class="text-xl text-gray-600">Tech tips, product reviews, and industry insights</p>
    </div>

    <!-- Featured Post -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl overflow-hidden mb-16">
        <div class="grid md:grid-cols-2">
            <div class="p-12 text-white">
                <div class="text-emerald-100 text-sm font-semibold mb-4">FEATURED POST</div>
                <h2 class="text-4xl font-bold mb-4">Top 10 Gaming Laptops of 2024</h2>
                <p class="text-emerald-100 mb-6">Discover the best gaming laptops that deliver incredible performance without breaking the bank.</p>
                <a href="#" class="inline-block bg-white text-emerald-600 px-6 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition">
                    Read Article
                </a>
            </div>
            <div class="bg-gray-200 h-64 md:h-auto"></div>
        </div>
    </div>

    <!-- Blog Posts Grid -->
    <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-48 bg-gray-200"></div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 font-semibold mb-2">TECH TIPS</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">How to Choose the Perfect Keyboard</h3>
                <p class="text-gray-600 text-sm mb-4">A comprehensive guide to finding the keyboard that matches your typing style and needs.</p>
                <a href="#" class="text-emerald-600 font-semibold hover:underline text-sm">Read more →</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-48 bg-gray-200"></div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 font-semibold mb-2">PRODUCT REVIEW</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Best Budget Headsets for 2024</h3>
                <p class="text-gray-600 text-sm mb-4">Quality audio doesn't have to cost a fortune. Check out our top picks for budget-friendly headsets.</p>
                <a href="#" class="text-emerald-600 font-semibold hover:underline text-sm">Read more →</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-48 bg-gray-200"></div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 font-semibold mb-2">BUYING GUIDE</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Gaming Mouse Buying Guide</h3>
                <p class="text-gray-600 text-sm mb-4">Everything you need to know about DPI, polling rate, and ergonomics when choosing a gaming mouse.</p>
                <a href="#" class="text-emerald-600 font-semibold hover:underline text-sm">Read more →</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-48 bg-gray-200"></div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 font-semibold mb-2">INDUSTRY NEWS</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">The Future of PC Gaming</h3>
                <p class="text-gray-600 text-sm mb-4">Exploring upcoming trends and technologies that will shape the gaming landscape.</p>
                <a href="#" class="text-emerald-600 font-semibold hover:underline text-sm">Read more →</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-48 bg-gray-200"></div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 font-semibold mb-2">SETUP GUIDE</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Building Your Perfect Gaming Setup</h3>
                <p class="text-gray-600 text-sm mb-4">From desk to chair to monitor placement, create an ergonomic and stylish gaming space.</p>
                <a href="#" class="text-emerald-600 font-semibold hover:underline text-sm">Read more →</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition">
            <div class="h-48 bg-gray-200"></div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 font-semibold mb-2">MAINTENANCE</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">How to Clean Your Electronics</h3>
                <p class="text-gray-600 text-sm mb-4">Keep your tech looking and performing like new with these simple maintenance tips.</p>
                <a href="#" class="text-emerald-600 font-semibold hover:underline text-sm">Read more →</a>
            </div>
        </div>
    </div>

    <!-- Load More -->
    <div class="text-center mt-12">
        <button class="px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:border-emerald-600 hover:text-emerald-600 transition">
            Load More Articles
        </button>
    </div>
</div>
@endsection
