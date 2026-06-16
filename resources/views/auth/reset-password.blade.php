@extends('layout')

@section('title', __('messages.reset_password') . ' - Technorics')

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
                    {{ __('messages.set_new_password') }} 🔑
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('messages.set_new_password_desc') }}
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <ul class="text-red-800 dark:text-red-200 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.email') }}
                    </label>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           required 
                           readonly
                           value="{{ $email ?? old('email') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.new_password') }}
                    </label>
                    <input id="password" 
                           name="password" 
                           type="password" 
                           required
                           autofocus
                           placeholder="{{ __('messages.enter_new_password') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.confirm_password') }}
                    </label>
                    <input id="password_confirmation" 
                           name="password_confirmation" 
                           type="password" 
                           required
                           placeholder="{{ __('messages.confirm_new_password') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white py-3 px-4 rounded-lg font-semibold hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition duration-200 shadow-lg">
                    {{ __('messages.reset_password') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
