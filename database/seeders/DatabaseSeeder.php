<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['name' => 'Laptops', 'slug' => 'laptops', 'description' => 'High-performance gaming and work laptops'],
            ['name' => 'Keyboards', 'slug' => 'keyboards', 'description' => 'Mechanical and gaming keyboards'],
            ['name' => 'Mice', 'slug' => 'mice', 'description' => 'Gaming and ergonomic mice'],
            ['name' => 'Headsets', 'slug' => 'headsets', 'description' => 'Gaming and professional headsets'],
            ['name' => 'Monitors', 'slug' => 'monitors', 'description' => 'Gaming and professional monitors'],
            ['name' => 'Chairs', 'slug' => 'chairs', 'description' => 'Ergonomic gaming chairs'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Products
        $products = [
            [
                'category_id' => 1,
                'name' => 'ASUS ROG Strix G15 Gaming Laptop',
                'slug' => 'asus-rog-strix-g15',
                'description' => '15.6" FHD 144Hz, AMD Ryzen 9 5900HX, RTX 3070, 16GB RAM, 1TB SSD',
                'price' => 1799.99,
                'discount_price' => 1499.99,
                'image_url' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=600',
                'stock' => 15,
                'rating' => 4.8,
                'reviews_count' => 245,
                'brand' => 'ASUS',
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Corsair K95 RGB Platinum XT',
                'slug' => 'corsair-k95-rgb-platinum',
                'description' => 'Mechanical Gaming Keyboard, Cherry MX Speed switches, RGB backlighting',
                'price' => 199.99,
                'discount_price' => 159.99,
                'image_url' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=600',
                'stock' => 42,
                'rating' => 4.7,
                'reviews_count' => 512,
                'brand' => 'Corsair',
                'is_featured' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Logitech G Pro Wireless',
                'slug' => 'logitech-gpro-wireless',
                'description' => 'Ultra-lightweight wireless gaming mouse, HERO 25K sensor, 80 hour battery',
                'price' => 149.99,
                'discount_price' => 119.99,
                'image_url' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=600',
                'stock' => 67,
                'rating' => 4.9,
                'reviews_count' => 892,
                'brand' => 'Logitech',
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'SteelSeries Arctis Pro Wireless',
                'slug' => 'steelseries-arctis-pro',
                'description' => 'Premium wireless gaming headset, Hi-Res audio, dual battery system',
                'price' => 329.99,
                'discount_price' => 279.99,
                'image_url' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=600',
                'stock' => 34,
                'rating' => 4.7,
                'reviews_count' => 456,
                'brand' => 'SteelSeries',
                'is_featured' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'ASUS ROG Swift PG279QM',
                'slug' => 'asus-rog-swift-pg279qm',
                'description' => '27" QHD 240Hz IPS gaming monitor, G-SYNC, 1ms response time',
                'price' => 799.99,
                'discount_price' => 699.99,
                'image_url' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=600',
                'stock' => 18,
                'rating' => 4.9,
                'reviews_count' => 342,
                'brand' => 'ASUS',
                'is_featured' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'Secretlab TITAN Evo 2022',
                'slug' => 'secretlab-titan-evo',
                'description' => 'Premium gaming chair, NEO Hybrid Leatherette, magnetic memory foam',
                'price' => 549.99,
                'discount_price' => 499.99,
                'image_url' => 'https://images.unsplash.com/photo-1598550476439-6847785fcea6?w=600',
                'stock' => 28,
                'rating' => 4.9,
                'reviews_count' => 567,
                'brand' => 'Secretlab',
                'is_featured' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
