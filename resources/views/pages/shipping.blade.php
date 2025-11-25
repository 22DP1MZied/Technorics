@extends('layout')

@section('title', 'Shipping Information - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Shipping Information</span>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Shipping Information</h1>
        <p class="text-xl text-gray-600">Fast & reliable delivery worldwide</p>
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
                    <h2 class="text-3xl font-bold">FREE Shipping</h2>
                    <p class="text-emerald-100 text-lg">On orders over €100</p>
                </div>
            </div>
        </div>

        <!-- Shipping Methods -->
        <div class="bg-white rounded-xl shadow-sm p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Shipping Methods</h3>
            
            <div class="space-y-6">
                <div class="border-l-4 border-emerald-600 pl-6">
                    <h4 class="font-bold text-gray-900 mb-2">Standard Shipping (€9.99)</h4>
                    <p class="text-gray-600 mb-2">Delivery in 5-7 business days</p>
                    <p class="text-sm text-gray-500">Available for all regions</p>
                </div>

                <div class="border-l-4 border-blue-600 pl-6">
                    <h4 class="font-bold text-gray-900 mb-2">Express Shipping (€19.99)</h4>
                    <p class="text-gray-600 mb-2">Delivery in 2-3 business days</p>
                    <p class="text-sm text-gray-500">Available in major cities</p>
                </div>

                <div class="border-l-4 border-purple-600 pl-6">
                    <h4 class="font-bold text-gray-900 mb-2">Next-Day Delivery (€29.99)</h4>
                    <p class="text-gray-600 mb-2">Order before 2 PM for next-day delivery</p>
                    <p class="text-sm text-gray-500">Available in select areas</p>
                </div>
            </div>
        </div>

        <!-- International Shipping -->
        <div class="bg-white rounded-xl shadow-sm p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">International Shipping</h3>
            <p class="text-gray-600 mb-4">We ship to over 50 countries worldwide. International shipping rates and delivery times vary by destination.</p>
            
            <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-6">
                <p class="font-semibold text-gray-900 mb-2">Note on Customs & Duties</p>
                <p class="text-gray-600 text-sm">International orders may be subject to import duties and taxes, which are the responsibility of the customer.</p>
            </div>
        </div>

        <!-- Order Processing -->
        <div class="bg-white rounded-xl shadow-sm p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Order Processing</h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Orders are processed within 1-2 business days</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>You'll receive tracking information via email</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Orders placed on weekends ship on Monday</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Signature may be required for high-value items</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
