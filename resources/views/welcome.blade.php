<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technorics - Gaming Electronics</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white">

    <!-- Header -->
    <header class="bg-gray-950 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-2xl font-bold text-orange-500">Technorics</h1>
            <nav class="space-x-6">
                <a href="#" class="hover:text-orange-500 transition">Home</a>
                <a href="#" class="hover:text-orange-500 transition">Shop</a>
                <a href="#" class="hover:text-orange-500 transition">About</a>
                <a href="#" class="hover:text-orange-500 transition">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-orange-600 to-red-600 text-white">
        <div class="max-w-7xl mx-auto px-6 py-32 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Level Up Your Gaming Setup</h2>
            <p class="text-lg md:text-xl mb-6">Discover the best gaming hardware & accessories for your ultimate setup.</p>
            <a href="#" class="bg-gray-900 text-orange-500 px-6 py-3 rounded-lg font-semibold hover:bg-orange-500 hover:text-gray-900 transition">Shop Now</a>
        </div>
        <!-- Floating gaming icons (optional interactive effect) -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="animate-bounce-slow absolute top-10 left-20 text-white text-4xl">🎮</div>
            <div class="animate-bounce-slow absolute top-32 right-20 text-white text-3xl">🖱️</div>
            <div class="animate-bounce-slow absolute bottom-10 left-32 text-white text-5xl">💻</div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="max-w-7xl mx-auto px-6 py-16">
        <h3 class="text-3xl font-bold text-center mb-10">Featured Products</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            
            <!-- Product Card -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition">
                <img src="https://via.placeholder.com/400x250?text=Gaming+Laptop" alt="Gaming Laptop" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="text-xl font-semibold mb-2">Gaming Laptop</h4>
                    <p class="text-gray-300 mb-4">High-performance laptop for competitive gaming.</p>
                    <a href="#" class="bg-orange-500 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition">Buy Now</a>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition">
                <img src="https://via.placeholder.com/400x250?text=Mechanical+Keyboard" alt="Mechanical Keyboard" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="text-xl font-semibold mb-2">Mechanical Keyboard</h4>
                    <p class="text-gray-300 mb-4">Responsive keys for precision and speed.</p>
                    <a href="#" class="bg-orange-500 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition">Buy Now</a>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition">
                <img src="https://via.placeholder.com/400x250?text=Gaming+Mouse" alt="Gaming Mouse" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="text-xl font-semibold mb-2">Gaming Mouse</h4>
                    <p class="text-gray-300 mb-4">Precision sensor and customizable buttons.</p>
                    <a href="#" class="bg-orange-500 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition">Buy Now</a>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 text-gray-400 py-8 mt-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2025 Technorics. All rights reserved.</p>
            <p>Follow us on 
                <a href="#" class="text-orange-500 hover:underline">Twitter</a>, 
                <a href="#" class="text-orange-500 hover:underline">Instagram</a>, 
                <a href="#" class="text-orange-500 hover:underline">Facebook</a>
            </p>
        </div>
    </footer>

</body>
</html>

