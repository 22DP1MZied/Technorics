@extends('layout')

@section('title', 'Order Confirmation - Technorics')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Icon -->
        <div class="text-center mb-8">
            <div class="inline-block p-6 bg-green-100 rounded-full mb-6">
                <svg class="w-24 h-24 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Order Confirmed!</h1>
            <p class="text-xl text-gray-600">Thank you for your purchase</p>
        </div>

        <!-- Order Details Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 mb-1">Order Number</p>
                        <p class="text-2xl font-bold">{{ $order->order_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-emerald-100 mb-1">Order Date</p>
                        <p class="text-lg font-semibold">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Order Status -->
                <div class="flex items-center gap-3 mb-6 p-4 bg-green-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="font-semibold text-gray-900">Order Status: <span class="text-green-600">{{ ucfirst($order->status) }}</span></p>
                        <p class="text-sm text-gray-600">We'll send you shipping confirmation once your order is on its way</p>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Order Items</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex gap-4 pb-4 border-b">
                            <div class="w-20 h-20 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain p-2">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">{{ $item->product->name }}</h4>
                                <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">€{{ number_format($item->total, 2) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-gray-50 rounded-lg p-6 space-y-3">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-semibold">€{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span class="font-semibold">€{{ number_format($order->shipping, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Tax</span>
                        <span class="font-semibold">€{{ number_format($order->tax, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-2xl font-bold text-gray-900 pt-3 border-t">
                        <span>Total</span>
                        <span>€{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="mt-6 pt-6 border-t">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Shipping Address</h3>
                    <div class="text-gray-600">
                        <p class="font-semibold text-gray-900">{{ $order->shipping_name }}</p>
                        <p>{{ $order->shipping_address }}</p>
                        <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
                        <p>{{ $order->shipping_country }}</p>
                        <p class="mt-2">{{ $order->shipping_email }}</p>
                        <p>{{ $order->shipping_phone }}</p>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="mt-6 pt-6 border-t">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Payment Method</h3>
                    <p class="text-gray-600">{{ ucfirst($order->payment_method) }}</p>
                    <p class="text-sm text-gray-500 mt-1">Payment Status: <span class="text-green-600 font-semibold">{{ ucfirst($order->payment_status) }}</span></p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4">
            <a href="{{ route('home') }}" class="flex-1 text-center py-4 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
                Continue Shopping
            </a>
            <button onclick="window.print()" class="flex-1 text-center py-4 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:border-emerald-600 hover:text-emerald-600 transition">
                Print Receipt
            </button>
        </div>

        <!-- Help Text -->
        <div class="mt-8 text-center text-gray-600">
            <p class="mb-2">Questions about your order?</p>
            <a href="#" class="text-emerald-600 font-semibold hover:underline">Contact Support</a>
        </div>
    </div>
</div>
@endsection
