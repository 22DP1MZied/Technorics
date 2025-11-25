<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing data
        Product::truncate();
        Category::truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create Categories
        $categories = [
            [
                'name' => 'Laptops',
                'slug' => 'laptops',
                'description' => 'High-performance laptops for gaming, work, and entertainment',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400'
            ],
            [
                'name' => 'Keyboards',
                'slug' => 'keyboards',
                'description' => 'Mechanical and gaming keyboards for every typing style',
                'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400'
            ],
            [
                'name' => 'Mice',
                'slug' => 'mice',
                'description' => 'Precision gaming mice and ergonomic designs',
                'image' => 'https://images.unsplash.com/photo-1527814050087-3793815479db?w=400'
            ],
            [
                'name' => 'Headsets',
                'slug' => 'headsets',
                'description' => 'Gaming headsets with immersive sound quality',
                'image' => 'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=400'
            ],
            [
                'name' => 'Monitors',
                'slug' => 'monitors',
                'description' => 'High-refresh gaming monitors and professional displays',
                'image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=400'
            ],
            [
                'name' => 'Chairs',
                'slug' => 'chairs',
                'description' => 'Ergonomic gaming and office chairs for comfort',
                'image' => 'https://images.unsplash.com/photo-1580480055273-228ff5388ef8?w=400'
            ],
            // PC Components
            [
                'name' => 'CPUs (Processors)',
                'slug' => 'cpus',
                'description' => 'Intel and AMD processors for building your dream PC',
                'image' => 'https://images.unsplash.com/photo-1555617981-dac3880eac6e?w=400'
            ],
            [
                'name' => 'Graphics Cards (GPUs)',
                'slug' => 'gpus',
                'description' => 'NVIDIA and AMD graphics cards for gaming and rendering',
                'image' => 'https://images.unsplash.com/photo-1591488320449-011701bb6704?w=400'
            ],
            [
                'name' => 'Motherboards',
                'slug' => 'motherboards',
                'description' => 'ATX, Micro-ATX, and Mini-ITX motherboards',
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=400'
            ],
            [
                'name' => 'RAM (Memory)',
                'slug' => 'ram',
                'description' => 'DDR4 and DDR5 memory for smooth multitasking',
                'image' => 'https://images.unsplash.com/photo-1541029071515-84cc54f84dc5?w=400'
            ],
            [
                'name' => 'Storage (SSD/HDD)',
                'slug' => 'storage',
                'description' => 'Fast SSDs and high-capacity HDDs',
                'image' => 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=400'
            ],
            [
                'name' => 'Power Supplies (PSUs)',
                'slug' => 'psus',
                'description' => 'Reliable power supplies for stable PC performance',
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400'
            ],
            [
                'name' => 'PC Cases',
                'slug' => 'cases',
                'description' => 'Stylish cases with excellent airflow',
                'image' => 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?w=400'
            ],
            [
                'name' => 'Cooling Systems',
                'slug' => 'cooling',
                'description' => 'Air and liquid cooling solutions',
                'image' => 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?w=400'
            ],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Get category IDs
        $laptops = Category::where('slug', 'laptops')->first()->id;
        $keyboards = Category::where('slug', 'keyboards')->first()->id;
        $mice = Category::where('slug', 'mice')->first()->id;
        $headsets = Category::where('slug', 'headsets')->first()->id;
        $monitors = Category::where('slug', 'monitors')->first()->id;
        $chairs = Category::where('slug', 'chairs')->first()->id;
        $cpus = Category::where('slug', 'cpus')->first()->id;
        $gpus = Category::where('slug', 'gpus')->first()->id;
        $motherboards = Category::where('slug', 'motherboards')->first()->id;
        $ram = Category::where('slug', 'ram')->first()->id;
        $storage = Category::where('slug', 'storage')->first()->id;
        $psus = Category::where('slug', 'psus')->first()->id;
        $cases = Category::where('slug', 'cases')->first()->id;
        $cooling = Category::where('slug', 'cooling')->first()->id;

        $products = [
            // LAPTOPS (15 products)
            ['name' => 'ASUS ROG Strix G15', 'category_id' => $laptops, 'brand' => 'ASUS', 'price' => 1299.99, 'discount_price' => 1099.99],
            ['name' => 'MSI GE76 Raider', 'category_id' => $laptops, 'brand' => 'MSI', 'price' => 1899.99, 'discount_price' => null],
            ['name' => 'Lenovo Legion 5 Pro', 'category_id' => $laptops, 'brand' => 'Lenovo', 'price' => 1399.99, 'discount_price' => 1199.99],
            ['name' => 'Acer Predator Helios 300', 'category_id' => $laptops, 'brand' => 'Acer', 'price' => 1199.99, 'discount_price' => null],
            ['name' => 'Dell G15 Gaming Laptop', 'category_id' => $laptops, 'brand' => 'Dell', 'price' => 999.99, 'discount_price' => 849.99],
            ['name' => 'HP Omen 17', 'category_id' => $laptops, 'brand' => 'HP', 'price' => 1699.99, 'discount_price' => null],
            ['name' => 'Razer Blade 15', 'category_id' => $laptops, 'brand' => 'Razer', 'price' => 2299.99, 'discount_price' => 1999.99],
            ['name' => 'ASUS TUF Gaming A15', 'category_id' => $laptops, 'brand' => 'ASUS', 'price' => 899.99, 'discount_price' => null],
            ['name' => 'Gigabyte AORUS 15', 'category_id' => $laptops, 'brand' => 'Gigabyte', 'price' => 1599.99, 'discount_price' => 1399.99],
            ['name' => 'Alienware m15 R7', 'category_id' => $laptops, 'brand' => 'Dell', 'price' => 2499.99, 'discount_price' => null],
            ['name' => 'MSI Stealth 15M', 'category_id' => $laptops, 'brand' => 'MSI', 'price' => 1099.99, 'discount_price' => 949.99],
            ['name' => 'Lenovo IdeaPad Gaming 3', 'category_id' => $laptops, 'brand' => 'Lenovo', 'price' => 799.99, 'discount_price' => null],
            ['name' => 'ASUS Zenbook Pro 15', 'category_id' => $laptops, 'brand' => 'ASUS', 'price' => 1799.99, 'discount_price' => null],
            ['name' => 'Acer Nitro 5', 'category_id' => $laptops, 'brand' => 'Acer', 'price' => 849.99, 'discount_price' => 749.99],
            ['name' => 'HP Pavilion Gaming 15', 'category_id' => $laptops, 'brand' => 'HP', 'price' => 899.99, 'discount_price' => null],

            // KEYBOARDS (12 products)
            ['name' => 'Corsair K95 RGB Platinum', 'category_id' => $keyboards, 'brand' => 'Corsair', 'price' => 199.99, 'discount_price' => 169.99],
            ['name' => 'Logitech G Pro X Keyboard', 'category_id' => $keyboards, 'brand' => 'Logitech', 'price' => 149.99, 'discount_price' => null],
            ['name' => 'Razer BlackWidow V3', 'category_id' => $keyboards, 'brand' => 'Razer', 'price' => 139.99, 'discount_price' => 119.99],
            ['name' => 'SteelSeries Apex Pro', 'category_id' => $keyboards, 'brand' => 'SteelSeries', 'price' => 199.99, 'discount_price' => null],
            ['name' => 'HyperX Alloy Origins', 'category_id' => $keyboards, 'brand' => 'HyperX', 'price' => 109.99, 'discount_price' => 89.99],
            ['name' => 'Ducky One 2 Mini', 'category_id' => $keyboards, 'brand' => 'Ducky', 'price' => 119.99, 'discount_price' => null],
            ['name' => 'Keychron K2', 'category_id' => $keyboards, 'brand' => 'Keychron', 'price' => 89.99, 'discount_price' => 79.99],
            ['name' => 'ASUS ROG Strix Scope', 'category_id' => $keyboards, 'brand' => 'ASUS', 'price' => 129.99, 'discount_price' => null],
            ['name' => 'Cooler Master MK730', 'category_id' => $keyboards, 'brand' => 'Cooler Master', 'price' => 159.99, 'discount_price' => 139.99],
            ['name' => 'Logitech G915 TKL', 'category_id' => $keyboards, 'brand' => 'Logitech', 'price' => 229.99, 'discount_price' => null],
            ['name' => 'Razer Huntsman Mini', 'category_id' => $keyboards, 'brand' => 'Razer', 'price' => 119.99, 'discount_price' => 99.99],
            ['name' => 'Corsair K70 RGB', 'category_id' => $keyboards, 'brand' => 'Corsair', 'price' => 169.99, 'discount_price' => null],

            // MICE (12 products)
            ['name' => 'Logitech G Pro Wireless', 'category_id' => $mice, 'brand' => 'Logitech', 'price' => 149.99, 'discount_price' => 129.99],
            ['name' => 'Razer DeathAdder V3', 'category_id' => $mice, 'brand' => 'Razer', 'price' => 69.99, 'discount_price' => null],
            ['name' => 'SteelSeries Rival 3', 'category_id' => $mice, 'brand' => 'SteelSeries', 'price' => 29.99, 'discount_price' => 24.99],
            ['name' => 'Corsair Dark Core RGB Pro', 'category_id' => $mice, 'brand' => 'Corsair', 'price' => 89.99, 'discount_price' => null],
            ['name' => 'Razer Viper Ultimate', 'category_id' => $mice, 'brand' => 'Razer', 'price' => 149.99, 'discount_price' => 119.99],
            ['name' => 'Logitech G502 Hero', 'category_id' => $mice, 'brand' => 'Logitech', 'price' => 79.99, 'discount_price' => null],
            ['name' => 'Glorious Model O', 'category_id' => $mice, 'brand' => 'Glorious', 'price' => 49.99, 'discount_price' => 39.99],
            ['name' => 'ASUS ROG Gladius III', 'category_id' => $mice, 'brand' => 'ASUS', 'price' => 99.99, 'discount_price' => null],
            ['name' => 'HyperX Pulsefire Haste', 'category_id' => $mice, 'brand' => 'HyperX', 'price' => 49.99, 'discount_price' => 44.99],
            ['name' => 'Razer Basilisk V3', 'category_id' => $mice, 'brand' => 'Razer', 'price' => 69.99, 'discount_price' => null],
            ['name' => 'Logitech MX Master 3', 'category_id' => $mice, 'brand' => 'Logitech', 'price' => 99.99, 'discount_price' => 89.99],
            ['name' => 'Corsair Ironclaw RGB', 'category_id' => $mice, 'brand' => 'Corsair', 'price' => 79.99, 'discount_price' => null],

            // HEADSETS (10 products) - FIXED DUPLICATE
            ['name' => 'SteelSeries Arctis 7', 'category_id' => $headsets, 'brand' => 'SteelSeries', 'price' => 149.99, 'discount_price' => 129.99],
            ['name' => 'HyperX Cloud II', 'category_id' => $headsets, 'brand' => 'HyperX', 'price' => 99.99, 'discount_price' => null],
            ['name' => 'Razer BlackShark V2', 'category_id' => $headsets, 'brand' => 'Razer', 'price' => 99.99, 'discount_price' => 84.99],
            ['name' => 'Logitech G Pro X Headset', 'category_id' => $headsets, 'brand' => 'Logitech', 'price' => 129.99, 'discount_price' => null],
            ['name' => 'Corsair Virtuoso RGB', 'category_id' => $headsets, 'brand' => 'Corsair', 'price' => 179.99, 'discount_price' => 159.99],
            ['name' => 'ASUS ROG Delta S', 'category_id' => $headsets, 'brand' => 'ASUS', 'price' => 159.99, 'discount_price' => null],
            ['name' => 'SteelSeries Arctis Pro', 'category_id' => $headsets, 'brand' => 'SteelSeries', 'price' => 179.99, 'discount_price' => null],
            ['name' => 'Razer Kraken V3', 'category_id' => $headsets, 'brand' => 'Razer', 'price' => 79.99, 'discount_price' => 69.99],
            ['name' => 'HyperX Cloud Alpha', 'category_id' => $headsets, 'brand' => 'HyperX', 'price' => 99.99, 'discount_price' => null],
            ['name' => 'Logitech G733', 'category_id' => $headsets, 'brand' => 'Logitech', 'price' => 129.99, 'discount_price' => 109.99],

            // MONITORS (10 products)
            ['name' => 'ASUS ROG Swift PG279QM 27"', 'category_id' => $monitors, 'brand' => 'ASUS', 'price' => 699.99, 'discount_price' => 599.99],
            ['name' => 'LG 27GL850 27" 144Hz', 'category_id' => $monitors, 'brand' => 'LG', 'price' => 449.99, 'discount_price' => null],
            ['name' => 'Samsung Odyssey G7 32"', 'category_id' => $monitors, 'brand' => 'Samsung', 'price' => 799.99, 'discount_price' => 699.99],
            ['name' => 'Acer Predator X34 34"', 'category_id' => $monitors, 'brand' => 'Acer', 'price' => 899.99, 'discount_price' => null],
            ['name' => 'BenQ ZOWIE XL2546K 24.5"', 'category_id' => $monitors, 'brand' => 'BenQ', 'price' => 499.99, 'discount_price' => 449.99],
            ['name' => 'Dell S2721DGF 27" 165Hz', 'category_id' => $monitors, 'brand' => 'Dell', 'price' => 399.99, 'discount_price' => null],
            ['name' => 'AOC CU34G2X 34" Curved', 'category_id' => $monitors, 'brand' => 'AOC', 'price' => 449.99, 'discount_price' => 399.99],
            ['name' => 'MSI Optix MAG274QRF 27"', 'category_id' => $monitors, 'brand' => 'MSI', 'price' => 399.99, 'discount_price' => null],
            ['name' => 'Gigabyte M27Q 27" IPS', 'category_id' => $monitors, 'brand' => 'Gigabyte', 'price' => 329.99, 'discount_price' => 299.99],
            ['name' => 'ViewSonic XG2405 24" 144Hz', 'category_id' => $monitors, 'brand' => 'ViewSonic', 'price' => 199.99, 'discount_price' => null],

            // CHAIRS (8 products)
            ['name' => 'Secretlab Titan Evo 2022', 'category_id' => $chairs, 'brand' => 'Secretlab', 'price' => 549.99, 'discount_price' => 499.99],
            ['name' => 'Herman Miller Aeron', 'category_id' => $chairs, 'brand' => 'Herman Miller', 'price' => 1395.00, 'discount_price' => null],
            ['name' => 'Noblechairs Hero', 'category_id' => $chairs, 'brand' => 'Noblechairs', 'price' => 499.99, 'discount_price' => 449.99],
            ['name' => 'DXRacer Formula Series', 'category_id' => $chairs, 'brand' => 'DXRacer', 'price' => 399.99, 'discount_price' => null],
            ['name' => 'Corsair T3 Rush', 'category_id' => $chairs, 'brand' => 'Corsair', 'price' => 329.99, 'discount_price' => 299.99],
            ['name' => 'Razer Iskur', 'category_id' => $chairs, 'brand' => 'Razer', 'price' => 499.99, 'discount_price' => null],
            ['name' => 'AKRacing Core Series', 'category_id' => $chairs, 'brand' => 'AKRacing', 'price' => 349.99, 'discount_price' => 319.99],
            ['name' => 'RESPAWN 110 Racing Chair', 'category_id' => $chairs, 'brand' => 'RESPAWN', 'price' => 199.99, 'discount_price' => null],

            // CPUs (15 products)
            ['name' => 'Intel Core i9-14900K', 'category_id' => $cpus, 'brand' => 'Intel', 'price' => 589.99, 'discount_price' => 549.99],
            ['name' => 'AMD Ryzen 9 7950X', 'category_id' => $cpus, 'brand' => 'AMD', 'price' => 699.99, 'discount_price' => null],
            ['name' => 'Intel Core i7-14700K', 'category_id' => $cpus, 'brand' => 'Intel', 'price' => 419.99, 'discount_price' => 389.99],
            ['name' => 'AMD Ryzen 7 7800X3D', 'category_id' => $cpus, 'brand' => 'AMD', 'price' => 449.99, 'discount_price' => null],
            ['name' => 'Intel Core i5-14600K', 'category_id' => $cpus, 'brand' => 'Intel', 'price' => 319.99, 'discount_price' => 299.99],
            ['name' => 'AMD Ryzen 5 7600X', 'category_id' => $cpus, 'brand' => 'AMD', 'price' => 299.99, 'discount_price' => null],
            ['name' => 'Intel Core i9-13900K', 'category_id' => $cpus, 'brand' => 'Intel', 'price' => 549.99, 'discount_price' => 499.99],
            ['name' => 'AMD Ryzen 9 7900X', 'category_id' => $cpus, 'brand' => 'AMD', 'price' => 549.99, 'discount_price' => null],
            ['name' => 'Intel Core i5-13600K', 'category_id' => $cpus, 'brand' => 'Intel', 'price' => 289.99, 'discount_price' => 269.99],
            ['name' => 'AMD Ryzen 7 7700X', 'category_id' => $cpus, 'brand' => 'AMD', 'price' => 399.99, 'discount_price' => null],
            ['name' => 'Intel Core i3-14100', 'category_id' => $cpus, 'brand' => 'Intel', 'price' => 149.99, 'discount_price' => 139.99],
            ['name' => 'AMD Ryzen 5 5600X', 'category_id' => $cpus, 'brand' => 'AMD', 'price' => 199.99, 'discount_price' => null],
            ['name' => 'Intel Core i7-13700K', 'category_id' => $cpus, 'brand' => 'Intel', 'price' => 399.99, 'discount_price' => 369.99],
            ['name' => 'AMD Ryzen 9 5900X', 'category_id' => $cpus, 'brand' => 'AMD', 'price' => 449.99, 'discount_price' => null],
            ['name' => 'Intel Core i5-12600K', 'category_id' => $cpus, 'brand' => 'Intel', 'price' => 269.99, 'discount_price' => 249.99],

            // GPUs (15 products)
            ['name' => 'NVIDIA RTX 4090', 'category_id' => $gpus, 'brand' => 'NVIDIA', 'price' => 1599.99, 'discount_price' => null],
            ['name' => 'AMD Radeon RX 7900 XTX', 'category_id' => $gpus, 'brand' => 'AMD', 'price' => 999.99, 'discount_price' => 949.99],
            ['name' => 'NVIDIA RTX 4080', 'category_id' => $gpus, 'brand' => 'NVIDIA', 'price' => 1199.99, 'discount_price' => null],
            ['name' => 'AMD Radeon RX 7900 XT', 'category_id' => $gpus, 'brand' => 'AMD', 'price' => 899.99, 'discount_price' => 849.99],
            ['name' => 'NVIDIA RTX 4070 Ti', 'category_id' => $gpus, 'brand' => 'NVIDIA', 'price' => 799.99, 'discount_price' => null],
            ['name' => 'AMD Radeon RX 7800 XT', 'category_id' => $gpus, 'brand' => 'AMD', 'price' => 499.99, 'discount_price' => 479.99],
            ['name' => 'NVIDIA RTX 4070', 'category_id' => $gpus, 'brand' => 'NVIDIA', 'price' => 599.99, 'discount_price' => null],
            ['name' => 'AMD Radeon RX 7700 XT', 'category_id' => $gpus, 'brand' => 'AMD', 'price' => 449.99, 'discount_price' => 429.99],
            ['name' => 'NVIDIA RTX 4060 Ti', 'category_id' => $gpus, 'brand' => 'NVIDIA', 'price' => 399.99, 'discount_price' => null],
            ['name' => 'AMD Radeon RX 7600', 'category_id' => $gpus, 'brand' => 'AMD', 'price' => 269.99, 'discount_price' => 249.99],
            ['name' => 'NVIDIA RTX 3060', 'category_id' => $gpus, 'brand' => 'NVIDIA', 'price' => 329.99, 'discount_price' => null],
            ['name' => 'AMD Radeon RX 6700 XT', 'category_id' => $gpus, 'brand' => 'AMD', 'price' => 379.99, 'discount_price' => 349.99],
            ['name' => 'NVIDIA RTX 3070', 'category_id' => $gpus, 'brand' => 'NVIDIA', 'price' => 499.99, 'discount_price' => null],
            ['name' => 'AMD Radeon RX 6800 XT', 'category_id' => $gpus, 'brand' => 'AMD', 'price' => 649.99, 'discount_price' => 599.99],
            ['name' => 'NVIDIA RTX 3080', 'category_id' => $gpus, 'brand' => 'NVIDIA', 'price' => 699.99, 'discount_price' => null],

            // MOTHERBOARDS (10 products)
            ['name' => 'ASUS ROG Maximus Z790 Hero', 'category_id' => $motherboards, 'brand' => 'ASUS', 'price' => 629.99, 'discount_price' => 589.99],
            ['name' => 'MSI MPG X670E Carbon WiFi', 'category_id' => $motherboards, 'brand' => 'MSI', 'price' => 449.99, 'discount_price' => null],
            ['name' => 'Gigabyte Z790 AORUS Master', 'category_id' => $motherboards, 'brand' => 'Gigabyte', 'price' => 549.99, 'discount_price' => 499.99],
            ['name' => 'ASRock X670E Taichi', 'category_id' => $motherboards, 'brand' => 'ASRock', 'price' => 499.99, 'discount_price' => null],
            ['name' => 'ASUS TUF Gaming Z790-Plus', 'category_id' => $motherboards, 'brand' => 'ASUS', 'price' => 279.99, 'discount_price' => 259.99],
            ['name' => 'MSI MAG B760 Tomahawk', 'category_id' => $motherboards, 'brand' => 'MSI', 'price' => 199.99, 'discount_price' => null],
            ['name' => 'Gigabyte B650 AORUS Elite', 'category_id' => $motherboards, 'brand' => 'Gigabyte', 'price' => 229.99, 'discount_price' => 209.99],
            ['name' => 'ASUS Prime Z690-P', 'category_id' => $motherboards, 'brand' => 'ASUS', 'price' => 219.99, 'discount_price' => null],
            ['name' => 'MSI PRO B650-A WiFi', 'category_id' => $motherboards, 'brand' => 'MSI', 'price' => 179.99, 'discount_price' => 169.99],
            ['name' => 'ASRock B660M Pro RS', 'category_id' => $motherboards, 'brand' => 'ASRock', 'price' => 119.99, 'discount_price' => null],

            // RAM (10 products)
            ['name' => 'Corsair Vengeance RGB 32GB DDR5', 'category_id' => $ram, 'brand' => 'Corsair', 'price' => 179.99, 'discount_price' => 159.99],
            ['name' => 'G.Skill Trident Z5 32GB DDR5', 'category_id' => $ram, 'brand' => 'G.Skill', 'price' => 189.99, 'discount_price' => null],
            ['name' => 'Kingston Fury Beast 32GB DDR5', 'category_id' => $ram, 'brand' => 'Kingston', 'price' => 149.99, 'discount_price' => 139.99],
            ['name' => 'Corsair Dominator Platinum 64GB DDR5', 'category_id' => $ram, 'brand' => 'Corsair', 'price' => 349.99, 'discount_price' => null],
            ['name' => 'G.Skill Ripjaws V 32GB DDR4', 'category_id' => $ram, 'brand' => 'G.Skill', 'price' => 89.99, 'discount_price' => 79.99],
            ['name' => 'Corsair Vengeance LPX 16GB DDR4', 'category_id' => $ram, 'brand' => 'Corsair', 'price' => 49.99, 'discount_price' => null],
            ['name' => 'Kingston Fury Beast 16GB DDR4', 'category_id' => $ram, 'brand' => 'Kingston', 'price' => 54.99, 'discount_price' => 47.99],
            ['name' => 'Crucial Ballistix 32GB DDR4', 'category_id' => $ram, 'brand' => 'Crucial', 'price' => 99.99, 'discount_price' => null],
            ['name' => 'TeamGroup T-Force Delta 16GB DDR4', 'category_id' => $ram, 'brand' => 'TeamGroup', 'price' => 59.99, 'discount_price' => 52.99],
            ['name' => 'ADATA XPG Spectrix 32GB DDR4', 'category_id' => $ram, 'brand' => 'ADATA', 'price' => 109.99, 'discount_price' => null],

            // STORAGE (10 products)
            ['name' => 'Samsung 990 PRO 2TB NVMe SSD', 'category_id' => $storage, 'brand' => 'Samsung', 'price' => 199.99, 'discount_price' => 179.99],
            ['name' => 'WD Black SN850X 1TB NVMe SSD', 'category_id' => $storage, 'brand' => 'Western Digital', 'price' => 119.99, 'discount_price' => null],
            ['name' => 'Crucial P5 Plus 1TB NVMe SSD', 'category_id' => $storage, 'brand' => 'Crucial', 'price' => 89.99, 'discount_price' => 79.99],
            ['name' => 'Samsung 870 EVO 1TB SATA SSD', 'category_id' => $storage, 'brand' => 'Samsung', 'price' => 99.99, 'discount_price' => null],
            ['name' => 'Kingston KC3000 2TB NVMe SSD', 'category_id' => $storage, 'brand' => 'Kingston', 'price' => 169.99, 'discount_price' => 149.99],
            ['name' => 'Seagate BarraCuda 4TB HDD', 'category_id' => $storage, 'brand' => 'Seagate', 'price' => 89.99, 'discount_price' => null],
            ['name' => 'WD Blue 2TB HDD', 'category_id' => $storage, 'brand' => 'Western Digital', 'price' => 54.99, 'discount_price' => 49.99],
            ['name' => 'Seagate IronWolf 8TB NAS HDD', 'category_id' => $storage, 'brand' => 'Seagate', 'price' => 219.99, 'discount_price' => null],
            ['name' => 'Crucial MX500 500GB SATA SSD', 'category_id' => $storage, 'brand' => 'Crucial', 'price' => 49.99, 'discount_price' => 44.99],
            ['name' => 'Sabrent Rocket 4 Plus 4TB NVMe', 'category_id' => $storage, 'brand' => 'Sabrent', 'price' => 399.99, 'discount_price' => null],

            // PSUs (8 products)
            ['name' => 'Corsair RM850x 850W 80+ Gold', 'category_id' => $psus, 'brand' => 'Corsair', 'price' => 149.99, 'discount_price' => 134.99],
            ['name' => 'EVGA SuperNOVA 1000 G6 1000W', 'category_id' => $psus, 'brand' => 'EVGA', 'price' => 199.99, 'discount_price' => null],
            ['name' => 'Seasonic Focus GX-750 750W', 'category_id' => $psus, 'brand' => 'Seasonic', 'price' => 119.99, 'discount_price' => 109.99],
            ['name' => 'be quiet! Straight Power 11 850W', 'category_id' => $psus, 'brand' => 'be quiet!', 'price' => 159.99, 'discount_price' => null],
            ['name' => 'Thermaltake Toughpower GF1 650W', 'category_id' => $psus, 'brand' => 'Thermaltake', 'price' => 99.99, 'discount_price' => 89.99],
            ['name' => 'Cooler Master V850 SFX Gold', 'category_id' => $psus, 'brand' => 'Cooler Master', 'price' => 139.99, 'discount_price' => null],
            ['name' => 'ASUS ROG Thor 1200W Platinum', 'category_id' => $psus, 'brand' => 'ASUS', 'price' => 349.99, 'discount_price' => 319.99],
            ['name' => 'MSI MPG A750GF 750W 80+ Gold', 'category_id' => $psus, 'brand' => 'MSI', 'price' => 109.99, 'discount_price' => null],

            // PC CASES (8 products)
            ['name' => 'NZXT H510 Elite', 'category_id' => $cases, 'brand' => 'NZXT', 'price' => 149.99, 'discount_price' => 129.99],
            ['name' => 'Corsair 4000D Airflow', 'category_id' => $cases, 'brand' => 'Corsair', 'price' => 104.99, 'discount_price' => null],
            ['name' => 'Lian Li O11 Dynamic EVO', 'category_id' => $cases, 'brand' => 'Lian Li', 'price' => 169.99, 'discount_price' => 154.99],
            ['name' => 'Fractal Design Meshify C', 'category_id' => $cases, 'brand' => 'Fractal Design', 'price' => 99.99, 'discount_price' => null],
            ['name' => 'be quiet! Pure Base 500DX', 'category_id' => $cases, 'brand' => 'be quiet!', 'price' => 109.99, 'discount_price' => 99.99],
            ['name' => 'Cooler Master H500', 'category_id' => $cases, 'brand' => 'Cooler Master', 'price' => 119.99, 'discount_price' => null],
            ['name' => 'Phanteks Eclipse P400A', 'category_id' => $cases, 'brand' => 'Phanteks', 'price' => 89.99, 'discount_price' => 79.99],
            ['name' => 'Thermaltake View 71 TG RGB', 'category_id' => $cases, 'brand' => 'Thermaltake', 'price' => 179.99, 'discount_price' => null],

            // COOLING (8 products)
            ['name' => 'Corsair iCUE H150i Elite LCD', 'category_id' => $cooling, 'brand' => 'Corsair', 'price' => 289.99, 'discount_price' => 269.99],
            ['name' => 'NZXT Kraken X63 280mm AIO', 'category_id' => $cooling, 'brand' => 'NZXT', 'price' => 149.99, 'discount_price' => null],
            ['name' => 'Noctua NH-D15 Air Cooler', 'category_id' => $cooling, 'brand' => 'Noctua', 'price' => 99.99, 'discount_price' => 89.99],
            ['name' => 'be quiet! Dark Rock Pro 4', 'category_id' => $cooling, 'brand' => 'be quiet!', 'price' => 89.99, 'discount_price' => null],
            ['name' => 'Arctic Liquid Freezer II 360', 'category_id' => $cooling, 'brand' => 'Arctic', 'price' => 119.99, 'discount_price' => 109.99],
            ['name' => 'Cooler Master Hyper 212 RGB', 'category_id' => $cooling, 'brand' => 'Cooler Master', 'price' => 44.99, 'discount_price' => null],
            ['name' => 'Lian Li Galahad 240mm AIO', 'category_id' => $cooling, 'brand' => 'Lian Li', 'price' => 129.99, 'discount_price' => 119.99],
            ['name' => 'Thermaltake Floe RC 360mm AIO', 'category_id' => $cooling, 'brand' => 'Thermaltake', 'price' => 149.99, 'discount_price' => null],
        ];

        foreach ($products as $productData) {
            $name = $productData['name'];
            $slug = Str::slug($name);
            
            Product::create([
                'category_id' => $productData['category_id'],
                'name' => $name,
                'slug' => $slug,
                'description' => "High-quality {$name} from {$productData['brand']}. Perfect for your gaming or professional setup.",
                'price' => $productData['price'],
                'discount_price' => $productData['discount_price'],
                'image_url' => 'https://via.placeholder.com/400x400?text=' . urlencode($name),
                'images' => json_encode([
                    'https://via.placeholder.com/400x400?text=Image1',
                    'https://via.placeholder.com/400x400?text=Image2',
                ]),
                'stock' => rand(5, 50),
                'rating' => rand(35, 50) / 10,
                'reviews_count' => rand(10, 500),
                'brand' => $productData['brand'],
                'specifications' => json_encode([
                    'Brand' => $productData['brand'],
                    'Warranty' => '1 Year',
                    'Condition' => 'New',
                ]),
                'is_featured' => rand(0, 1),
                'is_active' => true,
            ]);
        }

        $this->command->info('✅ Seeded ' . count($products) . ' products across 14 categories!');
    }
}
