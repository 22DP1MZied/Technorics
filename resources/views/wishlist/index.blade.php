@extends('layout')

@section('title', __('messages.wishlist') . ' - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">{{ __('messages.wishlist') }}</span>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">{{ __('messages.wishlist') }}</h1>

        @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($wishlistItems as $item)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl transition overflow-hidden">
                <div class="relative aspect-square overflow-hidden group">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    
                    @if($item->product->discount_price)
                    <div class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                        -{{ round((($item->product->price - $item->product->discount_price) / $item->product->price) * 100) }}%
                    </div>
                    @endif

                    <form action="{{ route('wishlist.remove', $item) }}" method="POST" class="absolute top-4 right-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-10 h-10 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white dark:hover:bg-gray-700 transition shadow-lg">
                            <svg class="w-5 h-5 text-red-500 fill-current" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="p-4">
                    <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold">{{ $item->product->category->name }}</span>
                    <h3 class="font-bold text-gray-900 dark:text-white mt-1 mb-2 line-clamp-2">{{ $item->product->name }}</h3>
                    
                    <div class="flex items-center gap-1 mb-2">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < floor($item->product->rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                        <span class="text-xs text-gray-600 dark:text-gray-400 ml-1">({{ $item->product->reviews_count }})</span>
                    </div>

                    <div class="mb-3">
                        @if($item->product->discount_price)
                        <div class="flex items-center gap-2">
                            <span class="text-xl font-bold text-red-600">€{{ number_format($item->product->discount_price, 2) }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400 line-through">€{{ number_format($item->product->price, 2) }}</span>
                        </div>
                        @else
                        <span class="text-xl font-bold text-gray-900 dark:text-white">€{{ number_format($item->product->price, 2) }}</span>
                        @endif
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('store.product', $item->product->slug) }}" class="flex-1 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white text-center py-2 rounded-lg font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            {{ __('messages.view') }}
                        </a>
                        <form action="{{ route('cart.add', $item->product) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-emerald-600 text-white py-2 rounded-lg font-semibold hover:bg-emerald-700 transition">
                                {{ __('messages.add_to_cart') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.empty_cart') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">{{ __('messages.start_shopping') }}</p>
            <a href="{{ route('store.index') }}" class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition">
                {{ __('messages.browse_products') }}
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
