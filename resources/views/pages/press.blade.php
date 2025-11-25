@extends('layout')

@section('title', 'Press & Media - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Press</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold text-gray-900 mb-6">Press & Media</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Latest news, press releases, and media resources
        </p>
    </div>

    <!-- Press Contact -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl p-8 text-white mb-16">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-2xl font-bold mb-4">Media Inquiries</h2>
            <p class="text-emerald-100 mb-6">For press inquiries, interviews, or media resources, please contact our press team</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="mailto:press@technorics.com" class="bg-white text-emerald-600 px-6 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition">
                    press@technorics.com
                </a>
                <span class="text-emerald-100">or</span>
                <span class="font-semibold">+1 (800) 123-PRESS</span>
            </div>
        </div>
    </div>

    <!-- Recent News -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Recent News</h2>
        
        <div class="space-y-8">
            <div class="bg-white rounded-xl shadow-sm p-8">
                <div class="text-sm text-emerald-600 font-semibold mb-2">November 20, 2024</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Technorics Expands to European Market</h3>
                <p class="text-gray-600 mb-4">Leading electronics retailer announces expansion into 10 new European countries, bringing premium tech products to millions of new customers.</p>
                <a href="#" class="text-emerald-600 font-semibold hover:underline">Read more →</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-8">
                <div class="text-sm text-emerald-600 font-semibold mb-2">October 15, 2024</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Technorics Hits 50,000 Customer Milestone</h3>
                <p class="text-gray-600 mb-4">Company celebrates serving 50,000 satisfied customers and announces new customer loyalty program.</p>
                <a href="#" class="text-emerald-600 font-semibold hover:underline">Read more →</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-8">
                <div class="text-sm text-emerald-600 font-semibold mb-2">September 5, 2024</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Technorics Partners with Leading Tech Brands</h3>
                <p class="text-gray-600 mb-4">New partnerships bring exclusive products and deals to Technorics customers.</p>
                <a href="#" class="text-emerald-600 font-semibold hover:underline">Read more →</a>
            </div>
        </div>
    </div>

    <!-- Media Resources -->
    <div class="bg-white rounded-xl shadow-sm p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Media Resources</h2>
        
        <div class="grid md:grid-cols-2 gap-6">
            <a href="#" class="border-2 border-gray-200 rounded-lg p-6 hover:border-emerald-600 transition">
                <h3 class="font-bold text-gray-900 mb-2">Brand Assets</h3>
                <p class="text-gray-600 text-sm">Download logos, brand guidelines, and official imagery</p>
            </a>
            <a href="#" class="border-2 border-gray-200 rounded-lg p-6 hover:border-emerald-600 transition">
                <h3 class="font-bold text-gray-900 mb-2">Company Fact Sheet</h3>
                <p class="text-gray-600 text-sm">Key facts, statistics, and company information</p>
            </a>
            <a href="#" class="border-2 border-gray-200 rounded-lg p-6 hover:border-emerald-600 transition">
                <h3 class="font-bold text-gray-900 mb-2">Executive Bios</h3>
                <p class="text-gray-600 text-sm">Leadership team profiles and headshots</p>
            </a>
            <a href="#" class="border-2 border-gray-200 rounded-lg p-6 hover:border-emerald-600 transition">
                <h3 class="font-bold text-gray-900 mb-2">Press Kit</h3>
                <p class="text-gray-600 text-sm">Complete media kit with all resources</p>
            </a>
        </div>
    </div>
</div>
@endsection
