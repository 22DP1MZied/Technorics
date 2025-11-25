@extends('layout')

@section('title', 'Returns & Refunds - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Returns & Refunds</span>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Returns & Refunds Policy</h1>
        <p class="text-xl text-gray-600">Your satisfaction is our priority</p>
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
                <h2 class="text-2xl font-bold text-gray-900">30-Day Return Policy</h2>
            </div>
            <p class="text-gray-600">We offer a hassle-free 30-day return policy on all products. If you're not completely satisfied with your purchase, you can return it within 30 days of delivery for a full refund.</p>
        </div>

        <!-- Return Requirements -->
        <div class="border-t pt-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Return Requirements</h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Product must be in original condition with all packaging and accessories</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Include the original receipt or proof of purchase</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Product must not show signs of wear or damage</span>
                </li>
            </ul>
        </div>

        <!-- How to Return -->
        <div class="border-t pt-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">How to Return</h3>
            <div class="space-y-4">
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">1</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Contact Us</h4>
                        <p class="text-gray-600">Email us at returns@technorics.com with your order number</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">2</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Get Authorization</h4>
                        <p class="text-gray-600">We'll send you a return authorization and shipping label</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">3</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Ship It Back</h4>
                        <p class="text-gray-600">Pack the item securely and ship using our prepaid label</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">4</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Get Your Refund</h4>
                        <p class="text-gray-600">Refund will be processed within 5-7 business days</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Button -->
        <div class="border-t pt-8 text-center">
            <a href="{{ route('pages.contact') }}" class="inline-block bg-emerald-600 text-white px-8 py-4 rounded-lg font-bold hover:bg-emerald-700 transition">
                Contact Support
            </a>
        </div>
    </div>
</div>
@endsection
