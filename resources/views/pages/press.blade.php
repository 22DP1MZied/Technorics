@extends('layout')

@section('title', __('messages.press') . ' - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">{{ __('messages.press') }}</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold text-gray-900 mb-6">{{ __('messages.press_title') }}</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            {{ __('messages.press_tagline') }}
        </p>
    </div>

    <!-- Press Contact -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl p-8 text-white mb-16">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-2xl font-bold mb-4">{{ __('messages.press_inquiries') }}</h2>
            <p class="text-emerald-100 mb-6">{{ __('messages.press_inquiries_desc') }}</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="mailto:press@technorics.com" class="bg-white text-emerald-600 px-6 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition">
                    press@technorics.com
                </a>
            </div>
        </div>
    </div>

    <!-- Recent News -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ __('messages.recent_news') }}</h2>
        
        <div class="space-y-8">
            <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md transition">
                <div class="text-sm text-emerald-600 font-semibold mb-2">2025</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">NVIDIA GeForce RTX 5090 — Jaunākā paaudze</h3>
                <p class="text-gray-600 mb-4">NVIDIA ir izlaidusi savu jaunāko GPU paaudzi ar revolucionāru veiktspēju un AI iespējām.</p>
                <a href="https://www.nvidia.com/en-us/geforce/graphics-cards/50-series/rtx-5090/" target="_blank" class="text-emerald-600 font-semibold hover:underline">{{ __('messages.read_more') }} →</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md transition">
                <div class="text-sm text-emerald-600 font-semibold mb-2">2025</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">AMD Ryzen 9000 sērija — Jaunumi</h3>
                <p class="text-gray-600 mb-4">AMD turpina konkurēt ar Intel, piedāvājot jaunus procesorus ar uzlabotu veiktspēju un energoefektivitāti.</p>
                <a href="https://www.amd.com/en/products/processors/desktops/ryzen.html" target="_blank" class="text-emerald-600 font-semibold hover:underline">{{ __('messages.read_more') }} →</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md transition">
                <div class="text-sm text-emerald-600 font-semibold mb-2">2025</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">CES 2025 — Labākie tehnoloģiju jaunumi</h3>
                <p class="text-gray-600 mb-4">Šogad CES izstādē tika prezentēti revolucionāri produkti spēļu, datortehnikas un elektronikas jomā.</p>
                <a href="https://www.ces.tech/" target="_blank" class="text-emerald-600 font-semibold hover:underline">{{ __('messages.read_more') }} →</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md transition">
                <div class="text-sm text-emerald-600 font-semibold mb-2">2025</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Intel Core Ultra 200 — Jaunā paaudze</h3>
                <p class="text-gray-600 mb-4">Intel prezentē savu jaunāko procesoru paaudzi ar iebūvētu AI akseleratoru un uzlabotu veiktspēju.</p>
                <a href="https://www.intel.com/content/www/us/en/products/details/processors/core-ultra.html" target="_blank" class="text-emerald-600 font-semibold hover:underline">{{ __('messages.read_more') }} →</a>
            </div>
        </div>
    </div>
</div>
@endsection
