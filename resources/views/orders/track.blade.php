@extends('layout')

@section('title', 'Track Order - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-800 py-4 border-b dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">Track Order</span>
        </div>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 dark:bg-gray-900 min-h-screen">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Track Your Order 📦</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400">Enter your order details to check the status</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
        @if (session('error'))
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
            <p class="text-red-800 dark:text-red-200">{{ session('error') }}</p>
        </div>
        @endif

        <form action="{{ route('pages.track-order.search') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Order Number *</label>
                <input type="text" 
                       name="order_number" 
                       value="{{ old('order_number') }}" 
                       required 
                       placeholder="e.g., ORD-123456789"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                @error('order_number')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Email Address *</label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       placeholder="Email used for the order"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white py-3 rounded-lg font-bold hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition duration-200 shadow-lg">
                Track Order 🔍
            </button>
        </form>

        <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
            <h3 class="font-bold text-gray-900 dark:text-white mb-4">Order Status Guide</h3>
            <div class="space-y-3 text-sm">
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                    <span class="text-gray-700 dark:text-gray-300"><strong>Pending:</strong> Order received, processing payment</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                    <span class="text-gray-700 dark:text-gray-300"><strong>Processing:</strong> Preparing your order</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 bg-purple-500 rounded-full"></span>
                    <span class="text-gray-700 dark:text-gray-300"><strong>Shipped:</strong> On the way to you</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                    <span class="text-gray-700 dark:text-gray-300"><strong>Delivered:</strong> Successfully delivered</span>
                </div>
            </div>
        </div>

        <div class="mt-6 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg p-4">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                💡 <strong>Tip:</strong> You can find your order number in the confirmation email we sent you.
            </p>
        </div>
    </div>

    <div class="mt-8 text-center">
        <p class="text-gray-600 dark:text-gray-400 mb-4">Need help?</p>
        <a href="{{ route('pages.contact') }}" 
           class="inline-block bg-white dark:bg-gray-800 text-emerald-600 dark:text-emerald-400 px-6 py-3 rounded-lg font-semibold border-2 border-emerald-600 dark:border-emerald-400 hover:bg-emerald-600 hover:text-white dark:hover:bg-emerald-600 transition">
            Contact Support
        </a>
    </div>
</div>
@endsection
