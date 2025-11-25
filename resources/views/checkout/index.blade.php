@extends('layout')

@section('title', 'Checkout - Technorics')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-emerald-600">Cart</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Checkout</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.process') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Shipping Information -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Shipping Information</h2>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                            <input type="text" name="shipping_name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" value="{{ auth()->user()->name }}">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                            <input type="email" name="shipping_email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" value="{{ auth()->user()->email }}">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Phone *</label>
                            <input type="tel" name="shipping_phone" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Country *</label>
                            <select name="shipping_country" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <option value="Latvia">Latvia</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Poland">Poland</option>
                                <option value="Germany">Germany</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Address *</label>
                            <input type="text" name="shipping_address" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Street address">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">City *</label>
                            <input type="text" name="shipping_city" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">State/Province *</label>
                            <input type="text" name="shipping_state" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">ZIP/Postal Code *</label>
                            <input type="text" name="shipping_zip" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Payment Method</h2>
                    
                    <div class="space-y-4">
                        <label class="flex items-center gap-4 p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-emerald-600 transition">
                            <input type="radio" name="payment_method" value="card" checked class="w-5 h-5 text-emerald-600">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900">Credit/Debit Card</div>
                                <div class="text-sm text-gray-600">Pay with Visa, Mastercard, or Amex</div>
                            </div>
                            <div class="flex gap-2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa" class="h-8">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="h-8">
                            </div>
                        </label>

                        <label class="flex items-center gap-4 p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-emerald-600 transition">
                            <input type="radio" name="payment_method" value="paypal" class="w-5 h-5 text-emerald-600">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900">PayPal</div>
                                <div class="text-sm text-gray-600">Fast and secure payment</div>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" class="h-8">
                        </label>

                        <label class="flex items-center gap-4 p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-emerald-600 transition">
                            <input type="radio" name="payment_method" value="bank" class="w-5 h-5 text-emerald-600">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900">Bank Transfer</div>
                                <div class="text-sm text-gray-600">Direct bank payment</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Order Notes -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Notes (Optional)</h2>
                    <textarea name="notes" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Any special instructions for your order?"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-emerald-600 text-white py-4 rounded-lg font-bold text-lg hover:bg-emerald-700 transition transform hover:scale-105 active:scale-95">
                    Place Order
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>

                <!-- Cart Items -->
                <div class="space-y-4 mb-6 max-h-64 overflow-y-auto">
                    @foreach($cartItems as $item)
                    <div class="flex gap-4">
                        <div class="w-16 h-16 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain p-1">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 text-sm">{{ $item->product->name }}</h4>
                            <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                            <p class="text-sm font-semibold text-gray-900">€{{ number_format($item->product->final_price * $item->quantity, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Totals -->
                <div class="space-y-3 pt-6 border-t">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-semibold">€{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span class="font-semibold">
                            @if($shipping > 0)
                                €{{ number_format($shipping, 2) }}
                            @else
                                <span class="text-green-600">FREE</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Tax (10%)</span>
                        <span class="font-semibold">€{{ number_format($tax, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-2xl font-bold text-gray-900 pt-3 border-t">
                        <span>Total</span>
                        <span>€{{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <!-- Security Badges -->
                <div class="mt-6 pt-6 border-t space-y-3">
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Secure 256-bit SSL encryption</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Your data is protected</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
