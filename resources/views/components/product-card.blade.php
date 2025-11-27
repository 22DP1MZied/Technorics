<div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group">
    <a href="{{ route('store.product', $product->slug) }}" class="block relative overflow-hidden">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
        
        @if($product->discount_price)
        <div class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-bold">
            -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
        </div>
        @endif

        @if($product->stock <= 0)
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <span class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold">Out of Stock</span>
        </div>
        @endif
    </a>

    <div class="p-4">
        <div class="text-sm text-emerald-600 dark:text-emerald-400 font-semibold mb-1">
            {{ $product->category->name }}
        </div>

        <a href="{{ route('store.product', $product->slug) }}" class="block">
            <h3 class="font-bold text-gray-900 dark:text-white mb-2 hover:text-emerald-600 transition line-clamp-2">
                {{ $product->name }}
            </h3>
        </a>

        <div class="flex items-center gap-2 mb-3">
            <div class="flex items-center">
                @php
                    $rating = $product->reviews->avg('rating') ?? 0;
                @endphp
                @for($i = 0; $i < 5; $i++)
                    <svg class="w-4 h-4 {{ $i < floor($rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @endfor
            </div>
            <span class="text-sm text-gray-600 dark:text-gray-400">({{ $product->reviews->count() }})</span>
        </div>

        <div class="mb-4">
            @if($product->discount_price)
            <div class="flex items-center gap-2">
                <span class="text-2xl font-bold text-red-600">€{{ number_format($product->discount_price, 2) }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400 line-through">€{{ number_format($product->price, 2) }}</span>
            </div>
            @else
            <span class="text-2xl font-bold text-gray-900 dark:text-white">€{{ number_format($product->price, 2) }}</span>
            @endif
        </div>

        <form action="{{ route('cart.add', $product) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700 transition flex items-center justify-center gap-2 {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Add to Cart
            </button>
        </form>
    </div>
</div>
