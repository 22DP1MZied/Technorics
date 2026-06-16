@extends('layout')

@section('title', 'Forgot Password - Technorics')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Technorics Logo" class="w-20 h-20 object-contain">
            </div>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ __('messages.forgot_password_title') }} 🔐
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('messages.forgot_password_desc') }}
                </p>
            </div>

            @if (session('status'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <p class="text-green-800 dark:text-green-200 text-sm">{{ session('status') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <p class="text-red-800 dark:text-red-200 text-sm">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.email') }}
                    </label>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           required 
                           autofocus
                           value="{{ old('email') }}"
                           placeholder="{{ __('messages.enter_email') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white py-3 px-4 rounded-lg font-semibold hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition duration-200 shadow-lg">
                    {{ __('messages.send_reset_link') }}
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    {{ __('messages.back_to_login') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
