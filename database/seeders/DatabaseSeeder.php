<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Plant;
use App\Models\Review;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin & Demo Customer Users
        User::updateOrCreate(
            ['email' => 'admin@indoreplants.com'],
            [
                'name' => 'Admin IndorePlants',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '+855 61 913 865',
                'address' => 'Phnom Penh, Cambodia',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@indoreplants.com'],
            [
                'name' => 'Sokha Meng',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'phone' => '+855 12 345 678',
                'address' => '#45, St 271, Tuol Kouk, Phnom Penh',
                'email_verified_at' => now(),
            ]
        );

        // 2. Categories
        $catAir = Category::create([
            'name' => 'Air Purifier',
            'slug' => 'air-purifier',
            'description' => 'Plants that actively remove toxins and refresh indoor room atmosphere.',
            'icon' => 'fa-wind',
            'is_active' => true,
        ]);

        $catTropical = Category::create([
            'name' => 'Tropical Indoor',
            'slug' => 'tropical-indoor',
            'description' => 'Lush tropical greenery designed for living rooms and stylish offices.',
            'icon' => 'fa-tree',
            'is_active' => true,
        ]);

        $catLowLight = Category::create([
            'name' => 'Low Light',
            'slug' => 'low-light',
            'description' => 'Hardy plants that thrive in shade, bedrooms, and low-light areas.',
            'icon' => 'fa-moon',
            'is_active' => true,
        ]);

        $catFlowering = Category::create([
            'name' => 'Flowering Indoor',
            'slug' => 'flowering-indoor',
            'description' => 'Elegant indoor plants that bloom beautiful flowers with gentle scents.',
            'icon' => 'fa-sun',
            'is_active' => true,
        ]);

        // 3. Plants
        $p1 = Plant::create([
            'category_id' => $catAir->id,
            'name' => 'Boston Fern',
            'slug' => 'boston-fern',
            'description' => 'Classic sword-shaped arching fronds. Outstanding natural air humidifier and purifier.',
            'price' => 15.00,
            'stock' => 25,
            'rating' => 5,
            'location' => 'Phnom Penh',
            'light_level' => 'Medium Indirect Light',
            'water_frequency' => 'Twice a week',
            'is_pet_friendly' => true,
            'is_featured' => true,
            'badge' => 'Best Seller',
            'image' => 'cart-1.png',
        ]);

        $p2 = Plant::create([
            'category_id' => $catTropical->id,
            'name' => 'Monstera Deliciosa',
            'slug' => 'monstera-deliciosa',
            'description' => 'Famous Swiss cheese plant with iconic perforated leaves. Creates an instant tropical jungle vibe.',
            'price' => 24.00,
            'stock' => 18,
            'rating' => 5,
            'location' => 'Siem Reap',
            'light_level' => 'Bright Indirect Light',
            'water_frequency' => 'Once every 7-10 days',
            'is_pet_friendly' => false,
            'is_featured' => true,
            'badge' => 'Popular',
            'image' => 'cart-1.png',
        ]);

        $p3 = Plant::create([
            'category_id' => $catLowLight->id,
            'name' => 'Snake Plant (Sansevieria)',
            'slug' => 'snake-plant',
            'description' => 'Virtually indestructible indoor plant. Converts CO2 to oxygen overnight, perfect for bedrooms.',
            'price' => 18.00,
            'stock' => 30,
            'rating' => 5,
            'location' => 'Battambang',
            'light_level' => 'Low to Bright Light',
            'water_frequency' => 'Once every 2-3 weeks',
            'is_pet_friendly' => false,
            'is_featured' => true,
            'badge' => 'Easy Care',
            'image' => 'cart-1.png',
        ]);

        $p4 = Plant::create([
            'category_id' => $catFlowering->id,
            'name' => 'Peace Lily (Spathiphyllum)',
            'slug' => 'peace-lily',
            'description' => 'Glossy green foliage with striking white spathes. Filters airborne pollutants effortlessly.',
            'price' => 20.00,
            'stock' => 14,
            'rating' => 5,
            'location' => 'Phnom Penh',
            'light_level' => 'Low to Medium Light',
            'water_frequency' => 'Once a week',
            'is_pet_friendly' => false,
            'is_featured' => true,
            'badge' => 'New Arrival',
            'image' => 'cart-1.png',
        ]);

        $p5 = Plant::create([
            'category_id' => $catTropical->id,
            'name' => 'Fiddle Leaf Fig',
            'slug' => 'fiddle-leaf-fig',
            'description' => 'Statement floor plant with huge violin-shaped leaves for modern architectural interiors.',
            'price' => 35.00,
            'stock' => 8,
            'rating' => 5,
            'location' => 'Phnom Penh',
            'light_level' => 'Bright Indirect Light',
            'water_frequency' => 'Once every 7 days',
            'is_pet_friendly' => false,
            'is_featured' => false,
            'badge' => 'Trending',
            'image' => 'plant-1.png',
        ]);

        $p6 = Plant::create([
            'category_id' => $catAir->id,
            'name' => 'Spider Plant',
            'slug' => 'spider-plant',
            'description' => 'Fast growing, pet-safe plant with ribbon foliage and cascading baby plantlets.',
            'price' => 12.00,
            'stock' => 20,
            'rating' => 4,
            'location' => 'Kandal',
            'light_level' => 'Bright Indirect Light',
            'water_frequency' => 'Once a week',
            'is_pet_friendly' => true,
            'is_featured' => false,
            'badge' => 'Pet Friendly',
            'image' => 'plant-2.png',
        ]);

        // 4. Customer Reviews
        Review::create([
            'plant_id' => $p1->id,
            'reviewer_name' => 'Kongboo Tang',
            'reviewer_role' => 'Verified Buyer',
            'rating' => 5,
            'comment' => 'The plants arrived perfectly packaged and super healthy! Adding green life into my home office has completely boosted my focus.',
            'is_approved' => true,
        ]);

        Review::create([
            'plant_id' => $p2->id,
            'reviewer_name' => 'Sophea Kim',
            'reviewer_role' => 'Interior Designer',
            'rating' => 5,
            'comment' => 'IndorePlants offers incredible customer service and top quality indoor greenery. Highly recommended for modern indoor styling.',
            'is_approved' => true,
        ]);

        Review::create([
            'plant_id' => $p3->id,
            'reviewer_name' => 'Vannak Chan',
            'reviewer_role' => 'Plant Enthusiast',
            'rating' => 5,
            'comment' => 'Fast delivery and the care instructions included were super helpful. My Boston Fern is thriving beautifully!',
            'is_approved' => true,
        ]);

        Review::create([
            'plant_id' => $p4->id,
            'reviewer_name' => 'Dara Rath',
            'reviewer_role' => 'Home Decorator',
            'rating' => 5,
            'comment' => 'Great prices, healthy plants, and fast response from their team. Will definitely order more plants for my apartment.',
            'is_approved' => true,
        ]);

        // 5. Demo Orders
        $order1 = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(6)),
            'customer_name' => 'Sokha Meng',
            'customer_email' => 'customer@indoreplants.com',
            'customer_phone' => '+855 12 345 678',
            'customer_address' => '#45, St 271, Tuol Kouk, Phnom Penh',
            'total_amount' => 39.00,
            'payment_method' => 'KHQR',
            'payment_status' => 'Paid',
            'order_status' => 'Processing',
            'notes' => 'Please deliver in the afternoon.',
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'plant_id' => $p1->id,
            'plant_name' => $p1->name,
            'unit_price' => $p1->price,
            'quantity' => 1,
            'subtotal' => 15.00,
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'plant_id' => $p2->id,
            'plant_name' => $p2->name,
            'unit_price' => $p2->price,
            'quantity' => 1,
            'subtotal' => 24.00,
        ]);

        $order2 = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(6)),
            'customer_name' => 'Chanthy Voeun',
            'customer_email' => 'chanthy@outlook.com',
            'customer_phone' => '+855 98 765 432',
            'customer_address' => '#12, BKK1, Phnom Penh',
            'total_amount' => 18.00,
            'payment_method' => 'COD',
            'payment_status' => 'Pending',
            'order_status' => 'Pending',
            'notes' => 'Call 10 minutes before arrival.',
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'plant_id' => $p3->id,
            'plant_name' => $p3->name,
            'unit_price' => $p3->price,
            'quantity' => 1,
            'subtotal' => 18.00,
        ]);
    }
}
