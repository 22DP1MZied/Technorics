@extends('layout')

@section('title', 'My Orders - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">My Orders</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">My Orders</h1>

    @if($orders->count() > 0)
    <div class="space-y-6">
        @foreach($orders as $order)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition">
            <!-- Order Header -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 p-6 text-white">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-emerald-100 text-sm mb-1">Order Number</p>
                        <p class="text-xl font-bold">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-emerald-100 text-sm mb-1">Order Date</p>
                        <p class="font-semibold">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-emerald-100 text-sm mb-1">Total</p>
                        <p class="text-xl font-bold">€{{ number_format($order->total, 2) }}</p>
                    </div>
                    <div>
                        <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-6">
                <div class="space-y-4 mb-6">
                    @foreach($order->orderItems->take(3) as $item)
                    <div class="flex items-center gap-4">
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

                    @if($order->orderItems->count() > 3)
                    <p class="text-sm text-gray-600 text-center pt-2">
                        + {{ $order->orderItems->count() - 3 }} more items
                    </p>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex gap-4 pt-4 border-t">
                    <a href="{{ route('orders.show', $order) }}" class="flex-1 text-center py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
                        View Details
                    </a>
                    <a href="{{ route('orders.show', $order) }}" class="flex-1 text-center py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:border-emerald-600 hover:text-emerald-600 transition">
                        Track Order
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
    @else
    <div class="text-center py-16">
        <div class="inline-block p-8 bg-gray-100 rounded-full mb-6">
            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4">No orders yet</h2>
        <p class="text-gray-600 mb-8">Looks like you haven't placed any orders</p>
        <a href="{{ route('store.index') }}" class="inline-block px-8 py-4 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
            Start Shopping
        </a>
    </div>
    @endif
</div>
@endsection
