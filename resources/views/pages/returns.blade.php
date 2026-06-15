@extends('layout')

@section('title', __('messages.returns') . ' - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">{{ __('messages.returns') }}</span>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.returns_policy') }}</h1>
        <p class="text-xl text-gray-600">{{ __('messages.satisfaction_priority') }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-8 space-y-8">
        <!-- 30-Day Return -->
        <div>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">{{ __('messages.return_30day') }}</h2>
            </div>
            <p class="text-gray-600">{{ __('messages.return_30day_desc') }}</p>
        </div>

        <!-- {{ __('messages.return_requirements') }} -->
        <div class="border-t pt-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ __('messages.return_requirements') }}</h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ __('messages.return_req_1') }}</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ __('messages.return_req_2') }}</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ __('messages.return_req_3') }}</span>
                </li>
            </ul>
        </div>

        <!-- {{ __('messages.how_to_return') }} -->
        <div class="border-t pt-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ __('messages.how_to_return') }}</h3>
            <div class="space-y-4">
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">1</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ __('messages.contact_us') }}</h4>
                        <p class="text-gray-600">{{ __('messages.return_step1_desc') }}</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">2</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ __('messages.return_step2') }}</h4>
                        <p class="text-gray-600">{{ __('messages.return_step2_desc') }}</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">3</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ __('messages.return_step3') }}</h4>
                        <p class="text-gray-600">{{ __('messages.return_step3_desc') }}</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">4</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ __('messages.return_step4') }}</h4>
                        <p class="text-gray-600">{{ __('messages.return_step4_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Button -->
        <div class="border-t pt-8 text-center">
            <a href="{{ route('pages.contact') }}" class="inline-block bg-emerald-600 text-white px-8 py-4 rounded-lg font-bold hover:bg-emerald-700 transition">
                {{ __('messages.contact_support') }}
            </a>
        </div>
    </div>
</div>
@endsection
