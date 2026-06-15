@extends('layout')

@section('title', __('messages.blog') . ' - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-800 py-4 border-b dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">{{ __('messages.blog') }}</span>
        </div>
    </div>
</div>

<!-- Hero -->
<div class="bg-gradient-to-br from-gray-900 via-emerald-900 to-teal-900 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold text-white mb-4">{{ __('messages.blog_title') }}</h1>
        <p class="text-xl text-emerald-100">{{ __('messages.blog_tagline') }}</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    <!-- Featured Post -->
    <div class="rounded-2xl overflow-hidden mb-16 shadow-xl">
        <div class="grid md:grid-cols-2">
            <div class="bg-gradient-to-br from-emerald-600 to-teal-600 p-12 text-white">
                <div class="inline-block bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full mb-4">⭐ {{ __('messages.featured_post') }}</div>
                <h2 class="text-4xl font-bold mb-4">{{ __('messages.blog_featured_title') }}</h2>
                <p class="text-emerald-100 mb-6">{{ __('messages.blog_featured_desc') }}</p>
                <a href="https://www.techradar.com/best/best-gaming-laptops" target="_blank" class="inline-block bg-white text-emerald-600 px-6 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition">
                    {{ __('messages.read_more') }} →
                </a>
            </div>
            <div class="h-64 md:h-auto overflow-hidden">
                <img src="https://images.unsplash.com/photo-1593640408182-31c70c8268f5?w=800" alt="Gaming Setup" class="w-full h-full object-cover">
            </div>
        </div>
    </div>

    <!-- Blog Posts Grid -->
    <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden hover:shadow-xl transition group">
            <div class="h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1541140532154-b024d705b90a?w=600" alt="Keyboard" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
            </div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mb-2">⌨️ {{ __('messages.blog_cat_tips') }}</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.blog_post1_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ __('messages.blog_post1_desc') }}</p>
                <a href="https://www.rtings.com/keyboard/reviews/best/gaming" target="_blank" class="text-emerald-600 font-semibold hover:underline text-sm">{{ __('messages.read_more') }} →</a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden hover:shadow-xl transition group">
            <div class="h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=600" alt="Headset" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
            </div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mb-2">🎧 {{ __('messages.blog_cat_review') }}</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.blog_post2_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ __('messages.blog_post2_desc') }}</p>
                <a href="https://www.rtings.com/headphones/reviews/best/gaming" target="_blank" class="text-emerald-600 font-semibold hover:underline text-sm">{{ __('messages.read_more') }} →</a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden hover:shadow-xl transition group">
            <div class="h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=600" alt="Mouse" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
            </div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mb-2">🖱️ {{ __('messages.blog_cat_guide') }}</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.blog_post3_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ __('messages.blog_post3_desc') }}</p>
                <a href="https://www.rtings.com/mouse/reviews/best/gaming" target="_blank" class="text-emerald-600 font-semibold hover:underline text-sm">{{ __('messages.read_more') }} →</a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden hover:shadow-xl transition group">
            <div class="h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=600" alt="PC Gaming" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
            </div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mb-2">🎮 {{ __('messages.blog_cat_news') }}</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.blog_post4_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ __('messages.blog_post4_desc') }}</p>
                <a href="https://www.pcgamer.com/hardware/" target="_blank" class="text-emerald-600 font-semibold hover:underline text-sm">{{ __('messages.read_more') }} →</a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden hover:shadow-xl transition group">
            <div class="h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1616588589676-62b3bd4ff6d2?w=600" alt="Gaming Setup" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
            </div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mb-2">🖥️ {{ __('messages.blog_cat_setup') }}</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.blog_post5_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ __('messages.blog_post5_desc') }}</p>
                <a href="https://www.pcmag.com/picks/the-best-gaming-desks" target="_blank" class="text-emerald-600 font-semibold hover:underline text-sm">{{ __('messages.read_more') }} →</a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden hover:shadow-xl transition group">
            <div class="h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1563206767-5b18f218e8de?w=600" alt="Cleaning PC" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
            </div>
            <div class="p-6">
                <div class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mb-2">🔧 {{ __('messages.blog_cat_maintenance') }}</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('messages.blog_post6_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ __('messages.blog_post6_desc') }}</p>
                <a href="https://www.howtogeek.com/clean-gaming-pc/" target="_blank" class="text-emerald-600 font-semibold hover:underline text-sm">{{ __('messages.read_more') }} →</a>
            </div>
        </div>
    </div>
</div>
@endsection
