@extends('layout')

@section('title', 'About Us - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">About Us</span>
        </div>
    </div>
</div>

<!-- Hero Section -->
<div class="bg-gradient-to-r from-emerald-600 to-teal-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">Our Story</h1>
        <p class="text-xl text-emerald-100 max-w-3xl mx-auto">
            Building the future of electronics retail, one satisfied customer at a time.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Mission Statement -->
    <div class="max-w-4xl mx-auto text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
        <p class="text-xl text-gray-600 leading-relaxed">
            At Technorics, we believe technology should be accessible, reliable, and exciting. We're dedicated to bringing you the latest and greatest electronics at unbeatable prices, backed by exceptional customer service.
        </p>
    </div>

    <!-- Values Grid -->
    <div class="grid md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Quality First</h3>
            <p class="text-gray-600">Every product is carefully selected and tested to meet our high standards.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Fast Delivery</h3>
            <p class="text-gray-600">Get your tech delivered quickly with our efficient shipping network.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Customer Focus</h3>
            <p class="text-gray-600">Your satisfaction is our top priority, always.</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl p-12 mb-16">
        <div class="grid md:grid-cols-4 gap-8 text-center text-white">
            <div>
                <div class="text-5xl font-bold mb-2">500+</div>
                <div class="text-emerald-100">Products</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">50K+</div>
                <div class="text-emerald-100">Happy Customers</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">30</div>
                <div class="text-emerald-100">Countries</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">99%</div>
                <div class="text-emerald-100">Satisfaction Rate</div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Meet Our Team</h2>
        <p class="text-xl text-gray-600">The people behind Technorics</p>
    </div>

    <div class="grid md:grid-cols-4 gap-8">
        <div class="text-center">
            <div class="w-32 h-32 bg-gradient-to-br from-emerald-400 to-teal-400 rounded-full mx-auto mb-4"></div>
            <h4 class="font-bold text-gray-900">John Smith</h4>
            <p class="text-gray-600">CEO & Founder</p>
        </div>
        <div class="text-center">
            <div class="w-32 h-32 bg-gradient-to-br from-blue-400 to-purple-400 rounded-full mx-auto mb-4"></div>
            <h4 class="font-bold text-gray-900">Sarah Johnson</h4>
            <p class="text-gray-600">Head of Operations</p>
        </div>
        <div class="text-center">
            <div class="w-32 h-32 bg-gradient-to-br from-pink-400 to-red-400 rounded-full mx-auto mb-4"></div>
            <h4 class="font-bold text-gray-900">Mike Chen</h4>
            <p class="text-gray-600">Chief Technology Officer</p>
        </div>
        <div class="text-center">
            <div class="w-32 h-32 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-full mx-auto mb-4"></div>
            <h4 class="font-bold text-gray-900">Emily Davis</h4>
            <p class="text-gray-600">Customer Success Lead</p>
        </div>
    </div>
</div>
@endsection
