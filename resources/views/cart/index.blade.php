@extends('layout')

@section('title', 'Shopping Cart - Technorics')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Shopping Cart</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg flex items-center gap-3">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if($cartItems->count() > 0)
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-4">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Shopping Cart ({{ $cartItems->count() }} items)</h1>

            @foreach($cartItems as $item)
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-6">
                <!-- Product Image -->
                <div class="w-24 h-24 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain p-2">
                </div>

                <!-- Product Info -->
                <div class="flex-1">
                    <a href="{{ route('store.product', $item->product->slug) }}" class="font-bold text-gray-900 hover:text-emerald-600 transition">
                        {{ $item->product->name }}
                    </a>
                    <p class="text-sm text-gray-600 mt-1">{{ $item->product->category->name }}</p>
                    <div class="mt-2">
                        <span class="text-xl font-bold text-gray-900">€{{ number_format($item->product->final_price, 2) }}</span>
                    </div>
                </div>

                <!-- Quantity Controls -->
                <div class="flex items-center gap-2">
                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center border-2 border-gray-300 rounded-lg overflow-hidden">
                        @csrf
                        @method('PATCH')
                        <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 transition" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </button>
                        <span class="px-4 py-2 font-semibold">{{ $item->quantity }}</span>
                        <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 transition" {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Item Total -->
                <div class="text-right">
                    <div class="text-xl font-bold text-gray-900">
                        €{{ number_format($item->product->final_price * $item->quantity, 2) }}
                    </div>
                </div>

                <!-- Remove Button -->
                <form action="{{ route('cart.remove', $item) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach

            <!-- Clear Cart -->
            <form action="{{ route('cart.clear') }}" method="POST" class="pt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-700 font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Clear Cart
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>

                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-semibold">€{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span class="font-semibold">
                            @if($total >= 100)
                                <span class="text-green-600">FREE</span>
                            @else
                                €9.99
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Tax (10%)</span>
                        <span class="font-semibold">€{{ number_format($total * 0.10, 2) }}</span>
                    </div>
                    
                    <div class="border-t pt-4">
                        <div class="flex justify-between text-xl font-bold text-gray-900">
                            <span>Total</span>
                            <span>€{{ number_format($total + ($total >= 100 ? 0 : 9.99) + ($total * 0.10), 2) }}</span>
                        </div>
                    </div>
                </div>

                @if($total < 100)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <p class="text-sm text-blue-800">
                        <strong>Tip:</strong> Add €{{ number_format(100 - $total, 2) }} more to get <strong>FREE shipping!</strong>
                    </p>
                </div>
                @endif

                @auth
                <a href="{{ route('checkout.index') }}" class="block w-full bg-emerald-600 text-white text-center py-4 rounded-lg font-bold text-lg hover:bg-emerald-700 transition transform hover:scale-105 active:scale-95">
                    Proceed to Checkout
                </a>
                @else
                <div class="space-y-3">
                    <a href="{{ route('login') }}" class="block w-full bg-emerald-600 text-white text-center py-4 rounded-lg font-bold text-lg hover:bg-emerald-700 transition">
                        Login to Checkout
                    </a>
                    <p class="text-center text-sm text-gray-600">
                        or
                        <a href="{{ route('register') }}" class="text-emerald-600 font-semibold hover:underline">Create an account</a>
                    </p>
                </div>
                @endauth

                <a href="{{ route('store.index') }}" class="block w-full mt-4 border-2 border-gray-300 text-gray-700 text-center py-3 rounded-lg font-semibold hover:border-emerald-600 hover:text-emerald-600 transition">
                    Continue Shopping
                </a>

                <!-- Trust Badges -->
                <div class="mt-6 pt-6 border-t space-y-3">
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Secure Checkout</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>30-Day Returns</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>1 Year Warranty</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Empty Cart -->
    <div class="text-center py-16">
        <div class="inline-block p-8 bg-gray-100 rounded-full mb-6">
            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Your cart is empty</h2>
        <p class="text-gray-600 mb-8">Looks like you haven't added anything to your cart yet</p>
        <a href="{{ route('store.index') }}" class="inline-block px-8 py-4 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition transform hover:scale-105">
            Start Shopping
        </a>
    </div>
    @endif
</div>
@endsection
