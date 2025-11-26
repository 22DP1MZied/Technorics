@extends('layout')

@section('title', __('messages.order_history') . ' - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">{{ __('messages.order_history') }}</span>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">{{ __('messages.order_history') }}</h1>

        @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white">{{ __('messages.order_number') }}: {{ $order->order_number }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.date') }}: {{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-emerald-600">€{{ number_format($order->total, 2) }}</p>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                            @elseif($order->status === 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                            @elseif($order->status === 'shipped') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                            @elseif($order->status === 'delivered') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                            @endif">
                            {{ __('messages.' . $order->status) }}
                        </span>
                    </div>
                </div>

                <div class="border-t dark:border-gray-700 pt-4">
                    <div class="space-y-3">
                        @foreach($order->items as $item)
                        <div class="flex items-center gap-4">
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.quantity') }}: {{ $item->quantity }}</p>
                            </div>
                            <p class="font-bold text-gray-900 dark:text-white">€{{ number_format($item->price * $item->quantity, 2) }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t dark:border-gray-700">
                    <a href="{{ route('orders.show', $order) }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                        {{ __('messages.view_details') }} →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.no_orders') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">{{ __('messages.start_shopping') }}</p>
            <a href="{{ route('store.index') }}" class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition">
                {{ __('messages.browse_products') }}
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
