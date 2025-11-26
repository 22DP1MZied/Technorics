@extends('layout')

@section('title', __('messages.my_profile') . ' - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">{{ __('messages.my_profile') }}</span>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">{{ __('messages.account_settings') }}</h1>

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-600 dark:text-emerald-400 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Sidebar -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 h-fit">
                <nav class="space-y-2">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 font-semibold">
                        {{ __('messages.personal_information') }}
                    </a>
                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                        {{ __('messages.order_history') }}
                    </a>
                    <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                        {{ __('messages.wishlist') }}
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="md:col-span-2 space-y-6">
                <!-- Personal Information -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">{{ __('messages.personal_information') }}</h2>
                    
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">{{ __('messages.name') }}</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none" required>
                                @error('name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">{{ __('messages.email') }}</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none" required>
                                @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition">
                                {{ __('messages.save_changes') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">{{ __('messages.change_password') }}</h2>
                    
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">{{ __('messages.current_password') }}</label>
                                <input type="password" name="current_password" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none" required>
                                @error('current_password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">{{ __('messages.new_password') }}</label>
                                <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none" required>
                                @error('password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">{{ __('messages.confirm_password') }}</label>
                                <input type="password" name="password_confirmation" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none" required>
                            </div>

                            <button type="submit" class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition">
                                {{ __('messages.update_profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
