@extends('layout')

@section('title', 'Contact Us - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-800 py-4 border-b dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">Contact Us</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 dark:bg-gray-900">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('messages.get_in_touch') }} 📧</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400">{{ __('messages.love_to_hear') }}</p>
    </div>

    <div class="grid md:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ __('messages.send_message_title') }}</h2>
            
            @if (session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-4 rounded">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-green-800 dark:text-green-200 font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded">
                    <ul class="text-red-800 dark:text-red-200 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('pages.contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.your_name') }}</label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name') }}"
                           required 
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.email') }}</label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           required 
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.subject') }}</label>
                    <select name="subject" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        <option value="">{{ __('messages.select_subject') }}</option>
                        <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                        <option value="Product Question" {{ old('subject') == 'Product Question' ? 'selected' : '' }}>Product Question</option>
                        <option value="Order Support" {{ old('subject') == 'Order Support' ? 'selected' : '' }}>Order Support</option>
                        <option value="Technical Support" {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                        <option value="Returns & Refunds" {{ old('subject') == 'Returns & Refunds' ? 'selected' : '' }}>{{ __('messages.faq_returns_title') }}</option>
                        <option value="Business Inquiry" {{ old('subject') == 'Business Inquiry' ? 'selected' : '' }}>Business Inquiry</option>
                        <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.message') }}</label>
                    <textarea name="message" 
                              rows="5" 
                              required 
                              placeholder="{{ __('messages.tell_us') }}"
                              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">{{ old('message') }}</textarea>
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white py-3 rounded-lg font-bold hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition duration-200 shadow-lg">
                    {{ __('messages.send_message_btn') }} ✉️
                </button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="space-y-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.phone') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">+371 2000 0000</p>
                        <p class="text-sm text-gray-500 dark:text-gray-500">{{ __('messages.phone_hours') }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.email') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">noreply.technorics@gmail.com</p>
                        <p class="text-sm text-gray-500 dark:text-gray-500">{{ __('messages.respond_24h') }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.address') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Brīvības iela 123<br>
                            Rīga, LV-1001<br>
                            Latvia 🇱🇻
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-xl p-8 border-2 border-emerald-200 dark:border-emerald-800">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <h3 class="font-bold text-gray-900 dark:text-white text-xl">{{ __('messages.quick_support') }}</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('messages.ai_help') }}</p>
                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-emerald-200 dark:border-emerald-700">
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        💬 Click the <span class="font-bold text-emerald-600 dark:text-emerald-400">AI Assistant</span> button in the bottom-right corner of your screen for instant help.
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ __('messages.business_hours') }}
                </h3>
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <div class="flex justify-between">
                        <span>{{ __('messages.mon_fri') }}:</span>
                        <span class="font-semibold">9:00 AM - 6:00 PM</span>
                    </div>
                    <div class="flex justify-between">
                        <span>{{ __('messages.saturday') }}:</span>
                        <span class="font-semibold">10:00 AM - 4:00 PM</span>
                    </div>
                    <div class="flex justify-between">
                        <span>{{ __('messages.sunday') }}:</span>
                        <span class="font-semibold text-red-600 dark:text-red-400">{{ __('messages.closed') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">{{ __('messages.faq') }}</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                <h3 class="font-bold text-gray-900 dark:text-white mb-2">📦 {{ __('messages.faq_shipping_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('messages.faq_shipping_desc') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                <h3 class="font-bold text-gray-900 dark:text-white mb-2">🔄 {{ __('messages.faq_returns_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('messages.faq_returns_desc') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                <h3 class="font-bold text-gray-900 dark:text-white mb-2">🛡️ {{ __('messages.faq_warranty_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('messages.faq_warranty_desc') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
