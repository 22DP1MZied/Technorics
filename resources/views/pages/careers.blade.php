@extends('layout')

@section('title', __('messages.careers') . ' - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">{{ __('messages.careers') }}</span>
        </div>
    </div>
</div>

<div class="bg-gradient-to-r from-emerald-600 to-teal-600 py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="text-8xl mb-8">🚀</div>
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">{{ __('messages.careers_coming_soon') }}</h1>
        <p class="text-xl text-emerald-100 max-w-3xl mx-auto mb-8">
            {{ __('messages.careers_coming_soon_desc') }}
        </p>
        <div class="inline-block bg-white/20 backdrop-blur-sm border-2 border-white/30 rounded-2xl px-8 py-4">
            <p class="text-white font-semibold text-lg">{{ __('messages.careers_contact') }}</p>
            <a href="mailto:careers@technorics.com" class="text-emerald-200 hover:text-white transition">careers@technorics.com</a>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    <a href="{{ route('home') }}" class="inline-block bg-emerald-600 text-white px-8 py-4 rounded-lg font-bold hover:bg-emerald-700 transition">
        {{ __('messages.back_to_home') }}
    </a>
</div>
@endsection
