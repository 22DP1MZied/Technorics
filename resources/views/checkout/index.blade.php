@extends('layout')

@section('title', __('messages.checkout') . ' - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('cart.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.cart') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">{{ __('messages.checkout') }}</span>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">{{ __('messages.checkout') }}</h1>

        @if($errors->any())
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
            <ul class="list-disc list-inside text-red-800 dark:text-red-200">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Shipping & Payment -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Shipping Information -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('messages.shipping_information') }}</h2>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.full_name') }} *</label>
                                <input type="text" name="shipping_name" value="{{ old('shipping_name', Auth::user()->name) }}" required 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.email') }} *</label>
                                <input type="email" name="shipping_email" value="{{ old('shipping_email', Auth::user()->email) }}" required 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.phone') }} *</label>
                                <input type="tel" name="shipping_phone" value="{{ old('shipping_phone') }}" required 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.country') }} *</label>
                                <select name="shipping_country" required 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                                    <option value="Latvia" {{ old('shipping_country') == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                                    <option value="Estonia" {{ old('shipping_country') == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                                    <option value="Lithuania" {{ old('shipping_country') == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                                    <option value="Other" {{ old('shipping_country') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.address') }} *</label>
                                <input type="text" name="shipping_address" value="{{ old('shipping_address') }}" required placeholder="{{ __('messages.street_address') }}"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.city') }} *</label>
                                <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.state_province') }} *</label>
                                <input type="text" name="shipping_state" value="{{ old('shipping_state') }}" required 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.zip_postal_code') }} *</label>
                                <input type="text" name="shipping_zip" value="{{ old('shipping_zip') }}" required 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('messages.payment_method') }}</h2>
                        </div>

                        <div class="space-y-3">
                            <label class="flex items-center gap-4 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-emerald-500 transition">
                                <input type="radio" name="payment_method" value="card" checked class="w-5 h-5 text-emerald-600">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ __('messages.credit_debit_card') }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.visa_mastercard_amex') }}</div>
                                </div>
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </label>

                            <label class="flex items-center gap-4 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-emerald-500 transition">
                                <input type="radio" name="payment_method" value="paypal" class="w-5 h-5 text-emerald-600">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ __('messages.paypal') }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.fast_secure') }}</div>
                                </div>
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.067 8.478c.492.88.556 2.014.3 3.327-.74 3.806-3.276 5.12-6.514 5.12h-.5a.805.805 0 00-.794.68l-.04.22-.63 3.993-.028.15a.805.805 0 01-.794.68H7.72a.483.483 0 01-.477-.558L8.926 7.68a.946.946 0 01.934-.808h4.92c.66 0 1.24.041 1.744.127-.58 3.766-3.245 5.107-6.504 5.107h-.5a.805.805 0 00-.794.68l-.04.22-.63 3.993-.028.15a.805.805 0 01-.794.68H2.893a.483.483 0 01-.477-.558L3.99 3.685a.946.946 0 01.934-.808h4.92c3.968 0 6.685 1.687 7.224 5.601z"/>
                                </svg>
                            </label>

                            <label class="flex items-center gap-4 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-emerald-500 transition">
                                <input type="radio" name="payment_method" value="bank_transfer" class="w-5 h-5 text-emerald-600">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ __('messages.bank_transfer') }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.direct_bank_payment') }}</div>
                                </div>
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                                </svg>
                            </label>

                            <label class="flex items-center gap-4 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-emerald-500 transition">
                                <input type="radio" name="payment_method" value="cash_on_delivery" class="w-5 h-5 text-emerald-600">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ __('messages.cash_on_delivery') }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.pay_when_receive') }}</div>
                                </div>
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </label>
                        </div>
                    </div>

                    <!-- Order Notes -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('messages.order_notes') }} ({{ __('messages.optional') }})</h2>
                        </div>
                        <textarea name="notes" rows="4" placeholder="{{ __('messages.special_instructions') }}" 
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <!-- Right Column - Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm sticky top-24">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">{{ __('messages.order_summary') }}</h2>
                        
                        <!-- Cart Items -->
                        <div class="space-y-4 mb-6 max-h-64 overflow-y-auto">
                            @foreach($cartItems as $item)
                            <div class="flex gap-3">
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $item->product->name }}</h4>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ __('messages.quantity') }}: {{ $item->quantity }}</p>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">
                                        €{{ number_format(($item->product->discount_price ?? $item->product->price) * $item->quantity, 2) }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t dark:border-gray-700 pt-4 space-y-3">
                            <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                <span>{{ __('messages.subtotal') }}</span>
                                <span class="font-semibold">€{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                <span>{{ __('messages.shipping') }}</span>
                                <span class="font-semibold">
                                    @if($subtotal >= 100)
                                    <span class="text-emerald-600">{{ __('messages.free') }}</span>
                                    @else
                                    €{{ number_format($shipping, 2) }}
                                    @endif
                                </span>
                            </div>
                            @if($subtotal >= 100)
                            <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-lg p-2">
                                <p class="text-xs text-emerald-700 dark:text-emerald-300 text-center">
                                    🎉 {{ __('messages.free_shipping_qualified') }}
                                </p>
                            </div>
                            @endif
                            <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                <span>{{ __('messages.tax') }} (10%)</span>
                                <span class="font-semibold">€{{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="border-t dark:border-gray-700 pt-3">
                                <div class="flex justify-between text-2xl font-bold text-gray-900 dark:text-white">
                                    <span>{{ __('messages.total') }}</span>
                                    <span>€{{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full mt-6 bg-emerald-600 text-white py-4 rounded-lg font-semibold hover:bg-emerald-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            {{ __('messages.place_order') }}
                        </button>

                        <div class="mt-4 flex items-center justify-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <span>{{ __('messages.secure_ssl') }}</span>
                        </div>

                        <div class="mt-2 flex items-center justify-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>{{ __('messages.data_protected') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
