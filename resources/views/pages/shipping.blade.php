@extends('layout')

@section('title', __('messages.shipping_info') . ' - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">{{ __('messages.shipping_info') }}</span>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.shipping_info') }}</h1>
        <p class="text-xl text-gray-600">{{ __('messages.shipping_tagline') }}</p>
    </div>

    <div class="space-y-8">
        <!-- Free Shipping -->
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl p-8 text-white">
            <div class="flex items-center gap-4 mb-4">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                </svg>
                <div>
                    <h2 class="text-3xl font-bold">{{ __('messages.free_shipping_title') }}</h2>
                    <p class="text-emerald-100 text-lg">{{ __('messages.free_shipping_threshold') }}</p>
                </div>
            </div>
        </div>

        <!-- {{ __('messages.shipping_methods') }} -->
        <div class="bg-white rounded-xl shadow-sm p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ __('messages.shipping_methods') }}</h3>
            
            <div class="space-y-6">
                <div class="border-l-4 border-emerald-600 pl-6">
                    <h4 class="font-bold text-gray-900 mb-2">{{ __('messages.standard_shipping') }}</h4>
                    <p class="text-gray-600 mb-2">{{ __('messages.standard_shipping_time') }}</p>
                    <p class="text-sm text-gray-500">{{ __('messages.available_all_regions') }}</p>
                </div>

                <div class="border-l-4 border-blue-600 pl-6">
                    <h4 class="font-bold text-gray-900 mb-2">{{ __('messages.express_shipping') }}</h4>
                    <p class="text-gray-600 mb-2">{{ __('messages.express_shipping_time') }}</p>
                    <p class="text-sm text-gray-500">{{ __('messages.available_major_cities') }}</p>
                </div>

                <div class="border-l-4 border-purple-600 pl-6">
                    <h4 class="font-bold text-gray-900 mb-2">{{ __('messages.nextday_shipping') }}</h4>
                    <p class="text-gray-600 mb-2">{{ __('messages.nextday_shipping_time') }}</p>
                    <p class="text-sm text-gray-500">{{ __('messages.available_select_areas') }}</p>
                </div>
            </div>
        </div>

        <!-- {{ __('messages.international_shipping') }} -->
        <div class="bg-white rounded-xl shadow-sm p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ __('messages.international_shipping') }}</h3>
            <p class="text-gray-600 mb-4">{{ __('messages.international_shipping_desc') }}</p>
            
            <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-6">
                <p class="font-semibold text-gray-900 mb-2">{{ __('messages.customs_note') }}</p>
                <p class="text-gray-600 text-sm">{{ __('messages.customs_desc') }}</p>
            </div>
        </div>

        <!-- {{ __('messages.order_processing') }} -->
        <div class="bg-white rounded-xl shadow-sm p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ __('messages.order_processing') }}</h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ __('messages.processing_time') }}</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ __('messages.tracking_email') }}</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ __('messages.weekend_orders') }}</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ __('messages.signature_required') }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
