@extends('layout')

@section('title', 'Order Tracking - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Order Found -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Order Details</h1>
                    <p class="text-gray-600 dark:text-gray-400">Order #{{ $order->order_number }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Order Progress -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-12 h-12 rounded-full {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'bg-emerald-600' : 'bg-gray-300' }} flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400">Order Placed</p>
                    </div>
                    <div class="flex-1 h-1 {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'bg-emerald-600' : 'bg-gray-300' }}"></div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-12 h-12 rounded-full {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'bg-emerald-600' : 'bg-gray-300' }} flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400">Processing</p>
                    </div>
                    <div class="flex-1 h-1 {{ in_array($order->status, ['shipped', 'delivered']) ? 'bg-emerald-600' : 'bg-gray-300' }}"></div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-12 h-12 rounded-full {{ in_array($order->status, ['shipped', 'delivered']) ? 'bg-emerald-600' : 'bg-gray-300' }} flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400">Shipped</p>
                    </div>
                    <div class="flex-1 h-1 {{ $order->status === 'delivered' ? 'bg-emerald-600' : 'bg-gray-300' }}"></div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-12 h-12 rounded-full {{ $order->status === 'delivered' ? 'bg-emerald-600' : 'bg-gray-300' }} flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400">Delivered</p>
                    </div>
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Shipping Address</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $order->shipping_name }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $order->shipping_address }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $order->shipping_country }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Order Summary</h3>
                    <div class="space-y-1 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal:</span>
                            <span class="text-gray-900 dark:text-white font-semibold">€{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Shipping:</span>
                            <span class="text-gray-900 dark:text-white font-semibold">€{{ number_format($order->shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Tax:</span>
                            <span class="text-gray-900 dark:text-white font-semibold">€{{ number_format($order->tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between pt-2 border-t dark:border-gray-700">
                            <span class="text-gray-900 dark:text-white font-bold">Total:</span>
                            <span class="text-gray-900 dark:text-white font-bold text-lg">€{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Order Items</h2>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex items-center gap-4 pb-4 border-b dark:border-gray-700 last:border-b-0">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-lg">
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Quantity: {{ $item->quantity }}</p>
                    </div>
                    <p class="font-bold text-gray-900 dark:text-white">€{{ number_format($item->total, 2) }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('pages.track-order') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                ← Track Another Order
            </a>
        </div>
    </div>
</div>
@endsection
