@extends('layout')

@section('title', __('messages.about_us') . ' - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">{{ __('messages.about_us') }}</span>
        </div>
    </div>
</div>

<!-- Hero Section -->
<div class="bg-gradient-to-r from-emerald-600 to-teal-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">{{ __('messages.our_story') }}</h1>
        <p class="text-xl text-emerald-100 max-w-3xl mx-auto">
            {{ __('messages.about_tagline') }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Mission Statement -->
    <div class="max-w-4xl mx-auto text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('messages.about_mission_title') }}</h2>
        <p class="text-xl text-gray-600 leading-relaxed">
            {{ __('messages.about_mission_desc') }}
        </p>
    </div>

    <!-- Values Grid -->
    <div class="grid md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('messages.about_quality') }}</h3>
            <p class="text-gray-600">{{ __('messages.about_quality_desc') }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('messages.fast_shipping') }}</h3>
            <p class="text-gray-600">{{ __('messages.about_delivery_desc') }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('messages.about_customer') }}</h3>
            <p class="text-gray-600">{{ __('messages.about_customer_desc') }}</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl p-12 mb-16">
        <div class="grid md:grid-cols-4 gap-8 text-center text-white">
            <div>
                <div class="text-5xl font-bold mb-2">500+</div>
                <div class="text-emerald-100">{{ __('messages.products') }}</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">50K+</div>
                <div class="text-emerald-100">{{ __('messages.happy_customers') }}</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">30</div>
                <div class="text-emerald-100">{{ __('messages.countries') }}</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">99%</div>
                <div class="text-emerald-100">{{ __('messages.satisfaction') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
