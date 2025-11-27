@extends('layout')

@section('title', 'Order #' . $order->order_number . ' - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-emerald-600">My Orders</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">{{ $order->order_number }}</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Header -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Order #{{ $order->order_number }}</h1>
                        <p class="text-gray-600">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                    </div>
                    <span class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full font-semibold">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <!-- Order Status Timeline -->
                <div class="relative">
                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                    
                    <div class="relative space-y-6">
                        <!-- Order Placed -->
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center flex-shrink-0 z-10">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Order Placed</p>
                                <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>

                        <!-- Processing -->
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 bg-{{ $order->status === 'pending' ? 'gray-300' : 'emerald-600' }} rounded-full flex items-center justify-center flex-shrink-0 z-10">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Processing</p>
                                <p class="text-sm text-gray-600">We're preparing your order</p>
                            </div>
                        </div>

                        <!-- Shipped -->
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0 z-10">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-600">Shipped</p>
                                <p class="text-sm text-gray-500">Pending</p>
                            </div>
                        </div>

                        <!-- Delivered -->
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0 z-10">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-600">Delivered</p>
                                <p class="text-sm text-gray-500">Pending</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Items</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-center gap-4 pb-4 border-b last:border-b-0">
                        <div class="w-24 h-24 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain p-2">
                        </div>
                        <div class="flex-1">
                            <a href="{{ route('store.product', $item->product->slug) }}" class="font-bold text-gray-900 hover:text-emerald-600 transition">
                                {{ $item->product->name }}
                            </a>
                            <p class="text-sm text-gray-600 mt-1">Quantity: {{ $item->quantity }}</p>
                            <p class="text-sm text-gray-600">Price: €{{ number_format($item->price, 2) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-900">€{{ number_format($item->total, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Summary Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24 space-y-6">
                <!-- Order Summary -->
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Order Summary</h2>
                    <div class="space-y-3">
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
                </div>

                <!-- Shipping Address -->
                <div class="pt-6 border-t">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Shipping Address</h3>
                    <div class="text-gray-600 text-sm space-y-1">
                        <p class="font-semibold text-gray-900">{{ $order->shipping_name }}</p>
                        <p>{{ $order->shipping_address }}</p>
                        <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
                        <p>{{ $order->shipping_country }}</p>
                        <p class="pt-2">{{ $order->shipping_phone }}</p>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="pt-6 border-t">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Payment Method</h3>
                    <p class="text-gray-600 capitalize">{{ $order->payment_method }}</p>
                    <p class="text-sm text-gray-500 mt-1">Status: <span class="text-green-600 font-semibold">{{ ucfirst($order->payment_status) }}</span></p>
                </div>

                <!-- Actions -->
                <div class="pt-6 border-t space-y-3">
                    <button onclick="window.print()" class="w-full py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:border-emerald-600 hover:text-emerald-600 transition">
                        Print Invoice
                    </button>
                    <a href="{{ route('orders.index') }}" class="block w-full text-center py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
                        Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
