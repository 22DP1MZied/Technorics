@extends('layout')

@section('title', __('messages.shopping_cart') . ' - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">{{ __('messages.shopping_cart') }}</span>
        </div>

        @if($cartItems->count() > 0)
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">{{ __('messages.shopping_cart') }} ({{ $cartItems->count() }} {{ __('messages.items') }})</h1>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 flex items-center gap-6 shadow-sm">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded-lg">
                    
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-1">{{ $item->product->name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $item->product->category->name }}</p>
                        <p class="text-xl font-bold text-emerald-600 mt-2">€{{ number_format($item->price, 2) }}</p>
                    </div>

                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        @method('PUT')
                        <button type="button" onclick="this.nextElementSibling.stepDown(); this.form.submit();" class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-600">
                            <span class="text-gray-600 dark:text-gray-300">−</span>
                        </button>
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 text-center border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg">
                        <button type="button" onclick="this.previousElementSibling.stepUp(); this.form.submit();" class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-600">
                            <span class="text-gray-600 dark:text-gray-300">+</span>
                        </button>
                    </form>

                    <p class="text-xl font-bold text-gray-900 dark:text-white w-24 text-right">€{{ number_format($item->price * $item->quantity, 2) }}</p>

                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach

                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center gap-2 text-red-600 hover:text-red-700 font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        {{ __('messages.clear_cart') }}
                    </button>
                </form>
            </div>

            <!-- Order Summary -->
            <div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm sticky top-24">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ __('messages.order_summary') }}</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                            <span>{{ __('messages.subtotal') }}</span>
                            <span class="font-semibold text-gray-900 dark:text-white">€{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                            <span>{{ __('messages.shipping') }}</span>
                            <span class="font-semibold text-emerald-600">{{ $shipping == 0 ? __('messages.free') : '€' . number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                            <span>{{ __('messages.tax') }} (10%)</span>
                            <span class="font-semibold text-gray-900 dark:text-white">€{{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="border-t dark:border-gray-700 pt-4">
                            <div class="flex justify-between text-xl font-bold">
                                <span class="text-gray-900 dark:text-white">{{ __('messages.total') }}</span>
                                <span class="text-emerald-600">€{{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full bg-emerald-600 text-white text-center py-4 rounded-lg font-bold text-lg hover:bg-emerald-700 transition mb-3">
                        {{ __('messages.proceed_to_checkout') }}
                    </a>

                    <a href="{{ route('store.index') }}" class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white text-center py-4 rounded-lg font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                        {{ __('messages.continue_shopping') }}
                    </a>

                    <div class="mt-6 space-y-3">
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('messages.secure_checkout') }}
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('messages.30_day_returns') }}
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('messages.1_year_warranty') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.empty_cart') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">{{ __('messages.add_products_compare') }}</p>
            <a href="{{ route('store.index') }}" class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition">
                {{ __('messages.start_shopping') }}
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
