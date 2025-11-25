@extends('layout')

@section('title', 'Careers - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Careers</span>
        </div>
    </div>
</div>

<div class="bg-gradient-to-r from-emerald-600 to-teal-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">Join Our Team</h1>
        <p class="text-xl text-emerald-100 max-w-3xl mx-auto">
            Help us revolutionize the electronics retail industry
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Why Join Us -->
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Why Work at Technorics?</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            We're building something special, and we want passionate people to join us on this journey.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Competitive Salary</h3>
            <p class="text-gray-600">We offer industry-leading compensation packages and performance bonuses.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-8">
            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Growth Opportunities</h3>
            <p class="text-gray-600">Continuous learning with training programs and career advancement paths.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-8">
            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Work-Life Balance</h3>
            <p class="text-gray-600">Flexible schedules, remote work options, and generous PTO policies.</p>
        </div>
    </div>

    <!-- Open Positions -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Open Positions</h2>
        
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-lg transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Senior Frontend Developer</h3>
                        <div class="flex items-center gap-4 text-gray-600 mb-4">
                            <span>📍 Remote</span>
                            <span>💼 Full-time</span>
                            <span>💰 $80k - $120k</span>
                        </div>
                        <p class="text-gray-600 mb-4">We're looking for an experienced frontend developer to help build our next-generation e-commerce platform.</p>
                    </div>
                    <a href="#" class="ml-6 px-6 py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition whitespace-nowrap">
                        Apply Now
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-lg transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Customer Success Manager</h3>
                        <div class="flex items-center gap-4 text-gray-600 mb-4">
                            <span>📍 San Francisco, CA</span>
                            <span>💼 Full-time</span>
                            <span>💰 $60k - $90k</span>
                        </div>
                        <p class="text-gray-600 mb-4">Join our customer success team to ensure every customer has an amazing experience.</p>
                    </div>
                    <a href="#" class="ml-6 px-6 py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition whitespace-nowrap">
                        Apply Now
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-lg transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Product Manager</h3>
                        <div class="flex items-center gap-4 text-gray-600 mb-4">
                            <span>📍 Hybrid</span>
                            <span>💼 Full-time</span>
                            <span>💰 $90k - $130k</span>
                        </div>
                        <p class="text-gray-600 mb-4">Lead product strategy and execution for our core e-commerce platform.</p>
                    </div>
                    <a href="#" class="ml-6 px-6 py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition whitespace-nowrap">
                        Apply Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-emerald-50 border-2 border-emerald-200 rounded-xl p-8 text-center">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Don't see a perfect fit?</h3>
        <p class="text-gray-600 mb-6">We're always looking for talented people. Send us your resume!</p>
        <a href="{{ route('pages.contact') }}" class="inline-block px-8 py-4 bg-emerald-600 text-white rounded-lg font-bold hover:bg-emerald-700 transition">
            Get in Touch
        </a>
    </div>
</div>
@endsection
