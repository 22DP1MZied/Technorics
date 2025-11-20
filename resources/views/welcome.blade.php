<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Technorics - Gaming Electronics</title>
@vite(['resources/css/app.css','resources/js/app.js'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
</head>
<body class="bg-gray-100 text-gray-900">

<!-- Header -->
<header class="bg-gray-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
        <h1 class="text-3xl font-bold text-orange-500">Technorics</h1>
        <nav class="space-x-6">
            <a href="#" class="hover:text-orange-400 transition">Home</a>
            <a href="#" class="hover:text-orange-400 transition">Shop</a>
            <a href="#" class="hover:text-orange-400 transition">Deals</a>
            <a href="#" class="hover:text-orange-400 transition">Contact</a>
        </nav>
    </div>
</header>

<!-- Hero Carousel -->
<section class="mt-4">
    <div class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide relative">
                <img src="https://via.placeholder.com/1600x500?text=Gaming+Deals+1" class="w-full object-cover"/>
                <div class="absolute inset-0 flex flex-col justify-center items-center bg-black bg-opacity-40 text-white">
                    <h2 class="text-4xl md:text-5xl font-bold">Epic Gaming Laptops</h2>
                    <a href="#" class="mt-4 px-6 py-2 bg-orange-500 rounded-lg font-semibold hover:bg-orange-600 transition">Shop Now</a>
                </div>
            </div>
            <div class="swiper-slide relative">
                <img src="https://via.placeholder.com/1600x500?text=Gaming+Deals+2" class="w-full object-cover"/>
                <div class="absolute inset-0 flex flex-col justify-center items-center bg-black bg-opacity-40 text-white">
                    <h2 class="text-4xl md:text-5xl font-bold">Mechanical Keyboards</h2>
                    <a href="#" class="mt-4 px-6 py-2 bg-orange-500 rounded-lg font-semibold hover:bg-orange-600 transition">Shop Now</a>
                </div>
            </div>
            <div class="swiper-slide relative">
                <img src="https://via.placeholder.com/1600x500?text=Gaming+Deals+3" class="w-full object-cover"/>
                <div class="absolute inset-0 flex flex-col justify-center items-center bg-black bg-opacity-40 text-white">
                    <h2 class="text-4xl md:text-5xl font-bold">High-Performance Mice</h2>
                    <a href="#" class="mt-4 px-6 py-2 bg-orange-500 rounded-lg font-semibold hover:bg-orange-600 transition">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next text-orange-500"></div>
        <div class="swiper-button-prev text-orange-500"></div>
    </div>
</section>

<!-- Featured Products Slider -->
<section class="max-w-7xl mx-auto px-6 py-16">
    <h3 class="text-3xl font-bold text-gray-900 mb-8">Featured Products</h3>
    <div class="swiper featured-swiper">
        <div class="swiper-wrapper">
            @for ($i = 1; $i <= 6; $i++)
            <div class="swiper-slide">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition">
                    <img src="https://via.placeholder.com/400x250?text=Product+{{ $i }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="text-xl font-semibold mb-2">Product {{ $i }}</h4>
                        <p class="text-gray-600 mb-4">Top quality gaming product for your setup.</p>
                        <a href="#" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition">Buy Now</a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next text-gray-900"></div>
        <div class="swiper-button-prev text-gray-900"></div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 py-8">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p>&copy; 2025 Technorics. All rights reserved.</p>
        <p>Follow us on 
            <a href="#" class="text-orange-500 hover:underline">Twitter</a>, 
            <a href="#" class="text-orange-500 hover:underline">Instagram</a>, 
            <a href="#" class="text-orange-500 hover:underline">Facebook</a>
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
        loop: true,
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        pagination: { el: '.swiper-pagination', clickable: true },
        autoplay: { delay: 4000, disableOnInteraction: false },
    });

    const featuredSwiper = new Swiper('.featured-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        navigation: { nextEl: '.featured-swiper .swiper-button-next', prevEl: '.featured-swiper .swiper-button-prev' },
        pagination: { el: '.featured-swiper .swiper-pagination', clickable: true },
        breakpoints: {
            640: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
        }
    });
</script>

</body>
</html>
