@extends('layout')

@section('title', 'Login - Technorics')

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
                    Welcome Back! 👋
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Sign in to continue shopping
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <p class="text-red-800 dark:text-red-200 text-sm">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Email Address
                    </label>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           required 
                           value="{{ old('email') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Password
                    </label>
                    <input id="password" 
                           name="password" 
                           type="password" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Remember me</span>
                    </label>
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white py-3 px-4 rounded-lg font-semibold hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition duration-200 shadow-lg">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">
                        Sign up now
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
