@extends('layout')

@section('title', 'My Wishlist - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Wishlist</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="text-3xl font-bold text-gray-900 mb-8">My Wishlist ({{ $wishlistItems->count() }} items)</h1>

    @if($wishlistItems->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($wishlistItems as $item)
        <div class="group bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="relative h-64 bg-gray-50 overflow-hidden">
                @if($item->product->discount_price)
                <div class="absolute top-3 left-3 z-10 bg-red-600 text-white text-sm font-bold px-3 py-1 rounded-full">
                    SALE
                </div>
                @endif

                <a href="{{ route('store.product', $item->product->slug) }}">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500">
                </a>

                <!-- Remove from Wishlist -->
                <form action="{{ route('wishlist.remove', $item) }}" method="POST" class="absolute top-3 right-3 z-10">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-10 h-10 bg-red-600 text-white rounded-full shadow-lg flex items-center justify-center hover:bg-red-700 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </form>
            </div>

            <div class="p-5">
                <div class="text-xs text-emerald-600 font-semibold mb-2">{{ $item->product->category->name }}</div>
                <a href="{{ route('store.product', $item->product->slug) }}">
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 h-12 hover:text-emerald-600 transition">{{ $item->product->name }}</h3>
                </a>
                
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 {{ $i < floor($item->product->rating) ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                    @endfor
                </div>

                <div class="mb-4">
                    @if($item->product->discount_price)
                    <div class="flex items-baseline gap-2">
                        <span class="text-2xl font-bold text-gray-900">€{{ number_format($item->product->discount_price, 2) }}</span>
                        <span class="text-sm text-gray-400 line-through">€{{ number_format($item->product->price, 2) }}</span>
                    </div>
                    @else
                    <span class="text-2xl font-bold text-gray-900">€{{ number_format($item->product->price, 2) }}</span>
                    @endif
                </div>

                <form action="{{ route('cart.add', $item->product) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700 transition transform hover:scale-105 active:scale-95">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16">
        <div class="inline-block p-8 bg-gray-100 rounded-full mb-6">
            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Your wishlist is empty</h2>
        <p class="text-gray-600 mb-8">Start adding products you love!</p>
        <a href="{{ route('store.index') }}" class="inline-block px-8 py-4 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
            Browse Products
        </a>
    </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
