@extends('layout')
@section('title', __('messages.track_order') . ' - Technorics')
@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">{{ __('messages.track_order') }}</span>
        </div>
    </div>
</div>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('messages.track_your_order') }} 📦</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400">{{ __('messages.enter_order_details') }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
        <form action="#" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.order_number') }} *</label>
                <input type="text" name="order_number" placeholder="e.g., ORD-123456789" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.email') }} *</label>
                <input type="email" name="email" placeholder="{{ __('messages.email_used_for_order') }}" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            <button type="submit" class="w-full bg-emerald-600 text-white py-4 rounded-lg font-bold text-lg hover:bg-emerald-700 transition">
                {{ __('messages.track_order') }} 🔍
            </button>
        </form>

        <div class="mt-8 pt-8 border-t dark:border-gray-700">
            <h3 class="font-bold text-gray-900 dark:text-white mb-4">{{ __('messages.order_status_guide') }}</h3>
            <ul class="space-y-3">
                <li class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-yellow-400 flex-shrink-0"></span>
                    <span class="text-sm text-gray-700 dark:text-gray-300"><strong>{{ __('messages.status_pending') }}:</strong> {{ __('messages.status_pending_desc') }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-blue-500 flex-shrink-0"></span>
                    <span class="text-sm text-gray-700 dark:text-gray-300"><strong>{{ __('messages.status_processing') }}:</strong> {{ __('messages.status_processing_desc') }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-purple-500 flex-shrink-0"></span>
                    <span class="text-sm text-gray-700 dark:text-gray-300"><strong>{{ __('messages.status_shipped') }}:</strong> {{ __('messages.status_shipped_desc') }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-emerald-500 flex-shrink-0"></span>
                    <span class="text-sm text-gray-700 dark:text-gray-300"><strong>{{ __('messages.status_delivered') }}:</strong> {{ __('messages.status_delivered_desc') }}</span>
                </li>
            </ul>
            <div class="mt-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg p-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">💡 <strong>{{ __('messages.tip') }}:</strong> {{ __('messages.find_order_number_tip') }}</p>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t dark:border-gray-700 text-center">
            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('messages.need_help') }}</p>
            <a href="{{ route('pages.contact') }}" class="inline-block border-2 border-emerald-600 text-emerald-600 px-6 py-2 rounded-lg font-semibold hover:bg-emerald-600 hover:text-white transition">
                {{ __('messages.contact_support') }}
            </a>
        </div>
    </div>
</div>
@endsection
