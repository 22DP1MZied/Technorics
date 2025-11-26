@extends('layout')

@section('title', __('messages.deals') . ' - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">{{ __('messages.deals') }}</span>
        </div>

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">🔥 {{ __('messages.flash_deals') }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $products->total() }} {{ __('messages.products') }}</p>
            </div>
        </div>

        <div class="flex gap-8">
            <!-- Filters Sidebar -->
            <div class="w-64 flex-shrink-0">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 sticky top-24">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('messages.filters') }}</h2>
                        @if(request()->hasAny(['category', 'brand', 'min_price', 'max_price', 'in_stock']))
                        <a href="{{ route('store.deals') }}" class="text-sm text-red-600 hover:text-red-700">{{ __('messages.clear_all') }}</a>
                        @endif
                    </div>

                    <form action="{{ route('store.deals') }}" method="GET" id="filter-form">
                        <!-- Category Filter -->
                        <div class="mb-6 pb-6 border-b dark:border-gray-700">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-3">{{ __('messages.category') }}</h3>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                <label class="flex items-center cursor-pointer group">
                                    <input 
                                        type="checkbox" 
                                        name="category[]" 
                                        value="{{ $category->slug }}"
                                        {{ in_array($category->slug, request('category', [])) ? 'checked' : '' }}
                                        onchange="document.getElementById('filter-form').submit()"
                                        class="w-4 h-4 text-emerald-600 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 group-hover:text-emerald-600">
                                        {{ $category->name }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-6 pb-6 border-b dark:border-gray-700">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-3">{{ __('messages.price_range') }}</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs text-gray-600 dark:text-gray-400">{{ __('messages.min_price') }}</label>
                                    <input 
                                        type="number" 
                                        name="min_price" 
                                        value="{{ request('min_price') }}"
                                        placeholder="€0"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-600 dark:text-gray-400">{{ __('messages.max_price') }}</label>
                                    <input 
                                        type="number" 
                                        name="max_price" 
                                        value="{{ request('max_price') }}"
                                        placeholder="€10000"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                                </div>
                                <button type="submit" class="w-full bg-emerald-600 text-white py-2 rounded-lg hover:bg-emerald-700 transition text-sm">
                                    {{ __('messages.apply') }}
                                </button>
                            </div>
                        </div>

                        <!-- Brand Filter -->
                        <div class="mb-6 pb-6 border-b dark:border-gray-700">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-3">{{ __('messages.brand') }}</h3>
                            <div class="space-y-2 max-h-48 overflow-y-auto">
                                @foreach($brands as $brand)
                                <label class="flex items-center cursor-pointer group">
                                    <input 
                                        type="checkbox" 
                                        name="brand[]" 
                                        value="{{ $brand }}"
                                        {{ in_array($brand, request('brand', [])) ? 'checked' : '' }}
                                        onchange="document.getElementById('filter-form').submit()"
                                        class="w-4 h-4 text-emerald-600 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 group-hover:text-emerald-600">
                                        {{ $brand }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Stock Filter -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-3">{{ __('messages.availability') }}</h3>
                            <label class="flex items-center cursor-pointer group">
                                <input 
                                    type="checkbox" 
                                    name="in_stock" 
                                    value="1"
                                    {{ request('in_stock') ? 'checked' : '' }}
                                    onchange="document.getElementById('filter-form').submit()"
                                    class="w-4 h-4 text-emerald-600 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 group-hover:text-emerald-600">
                                    {{ __('messages.in_stock_only') }}
                                </span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="flex-1">
                <!-- Sort Options -->
                <div class="flex items-center justify-between mb-6">
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('messages.showing') }} {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} {{ __('messages.of') }} {{ $products->total() }}
                    </p>
                    <form action="{{ route('store.deals') }}" method="GET" class="flex items-center gap-2">
                        <!-- Preserve filters -->
                        @foreach(request()->except('sort') as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $v)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        
                        <select name="sort" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('messages.newest') }}</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>{{ __('messages.price_low_high') }}</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>{{ __('messages.price_high_low') }}</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('messages.name_a_z') }}</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>{{ __('messages.highest_rated') }}</option>
                        </select>
                    </form>
                </div>

                @include('store.partials.product-grid', ['products' => $products])

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
