@extends('layout')

@section('title', 'Product Comparison - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 py-4 border-b dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">Home</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-900 dark:text-white font-semibold">Compare Products</span>
            </div>
            @if($products->count() > 0)
            <form action="{{ route('compare.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">
                    Clear All
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

<div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($products->count() === 0)
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Products to Compare</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Add products to comparison to see them here</p>
            <a href="{{ route('store.index') }}" class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition">
                Browse Products
            </a>
        </div>
        @else
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Compare Products</h1>
            <p class="text-gray-600 dark:text-gray-400">Compare up to 4 products side by side</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-white sticky left-0 bg-gray-50 dark:bg-gray-700">Specification</th>
                        @foreach($products as $product)
                        <th class="px-6 py-4 text-center min-w-[250px]">
                            <div class="flex flex-col items-center">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg mb-3">
                                <h3 class="font-bold text-gray-900 dark:text-white mb-1">{{ $product->name }}</h3>
                                <span class="text-xs text-gray-600 dark:text-gray-400">{{ $product->category->name }}</span>
                                <form action="{{ route('compare.remove', $product) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 text-sm">Remove</button>
                                </form>
                            </div>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Price -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">Price</td>
                        @foreach($products as $product)
                        <td class="px-6 py-4 text-center">
                            @if($product->discount_price)
                            <div>
                                <span class="text-2xl font-bold text-red-600">€{{ number_format($product->discount_price, 2) }}</span>
                                <div class="text-sm text-gray-500 dark:text-gray-400 line-through">€{{ number_format($product->price, 2) }}</div>
                            </div>
                            @else
                            <span class="text-2xl font-bold text-gray-900 dark:text-white">€{{ number_format($product->price, 2) }}</span>
                            @endif
                        </td>
                        @endforeach
                    </tr>

                    <!-- Rating -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">Rating</td>
                        @foreach($products as $product)
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-1">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5 {{ $i < floor($product->rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $product->rating }}/5 ({{ $product->reviews_count }} reviews)</div>
                        </td>
                        @endforeach
                    </tr>

                    <!-- Brand -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">Brand</td>
                        @foreach($products as $product)
                        <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-300">{{ $product->brand }}</td>
                        @endforeach
                    </tr>

                    <!-- Stock -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">Availability</td>
                        @foreach($products as $product)
                        <td class="px-6 py-4 text-center">
                            @if($product->stock > 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                In Stock ({{ $product->stock }})
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                Out of Stock
                            </span>
                            @endif
                        </td>
                        @endforeach
                    </tr>

                    <!-- Specifications -->
                    @php
                        $allSpecs = collect();
                        foreach($products as $product) {
                            $specs = json_decode($product->specifications, true);
                            if(is_array($specs)) {
                                $allSpecs = $allSpecs->merge(array_keys($specs));
                            }
                        }
                        $allSpecs = $allSpecs->unique()->filter(function($spec) {
                            return !in_array($spec, ['Brand', 'Warranty', 'Condition']);
                        });
                    @endphp

                    @foreach($allSpecs as $specKey)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white sticky left-0 bg-white dark:bg-gray-800">{{ $specKey }}</td>
                        @foreach($products as $product)
                        <td class="px-6 py-4 text-center text-gray-700 dark:text-gray-300">
                            @php
                                $specs = json_decode($product->specifications, true);
                                echo is_array($specs) && isset($specs[$specKey]) ? $specs[$specKey] : '-';
                            @endphp
                        </td>
                        @endforeach
                    </tr>
                    @endforeach

                    <!-- Actions -->
                    <tr class="bg-gray-50 dark:bg-gray-700">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white sticky left-0 bg-gray-50 dark:bg-gray-700">Actions</td>
                        @foreach($products as $product)
                        <td class="px-6 py-4 text-center">
                            <div class="flex flex-col gap-2">
                                <a href="{{ route('store.product', $product->slug) }}" class="bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-200 dark:hover:bg-gray-500 transition">
                                    View Details
                                </a>
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-emerald-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-emerald-700 transition">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
