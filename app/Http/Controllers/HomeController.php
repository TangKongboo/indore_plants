<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the application home page.
     */
    public function index()
    {
        $features = [
            [
                'icon' => 'fa-truck-fast',
                'title' => 'Fast & Free Delivery',
                'desc' => 'Quick home delivery across Cambodia with specialized plant packaging.'
            ],
            [
                'icon' => 'fa-shield-halved',
                'title' => 'Healthy Guarantee',
                'desc' => '30-day health guarantee for every indoor plant you purchase.'
            ],
            [
                'icon' => 'fa-headset',
                'title' => 'Plant Care Support',
                'desc' => 'Expert advice from our botanical team available 24/7 for plant maintenance.'
            ],
            [
                'icon' => 'fa-recycle',
                'title' => '100% Eco-Friendly',
                'desc' => 'Sustainable pots and organic nutrient soil with every order.'
            ],
        ];

        $plants = [
            [
                'id' => 1,
                'name' => 'Boston Fern',
                'category' => 'Air Purifier',
                'location' => 'Cambodia',
                'price' => 15,
                'rating' => 5,
                'badge' => 'Best Seller',
                'image' => asset('images/cart-1.png')
            ],
            [
                'id' => 2,
                'name' => 'Monstera Deliciosa',
                'category' => 'Tropical Indoor',
                'location' => 'Phnom Penh',
                'price' => 24,
                'rating' => 5,
                'badge' => 'Popular',
                'image' => asset('images/cart-1.png')
            ],
            [
                'id' => 3,
                'name' => 'Snake Plant',
                'category' => 'Low Light',
                'location' => 'Siem Reap',
                'price' => 18,
                'rating' => 4,
                'badge' => 'Easy Care',
                'image' => asset('images/cart-1.png')
            ],
            [
                'id' => 4,
                'name' => 'Peace Lily',
                'category' => 'Flowering Indoor',
                'location' => 'Battambang',
                'price' => 20,
                'rating' => 5,
                'badge' => 'New Arrival',
                'image' => asset('images/cart-1.png')
            ],
        ];

        $reviews = [
            [
                'name' => 'Kongboo Tang',
                'role' => 'Verified Buyer',
                'rating' => 5,
                'comment' => 'The plants arrived perfectly packaged and super healthy! Adding green life into my home office has completely boosted my focus.'
            ],
            [
                'name' => 'Sophea Kim',
                'role' => 'Interior Designer',
                'rating' => 5,
                'comment' => 'IndorePlants offers incredible customer service and top quality indoor greenery. Highly recommended for modern indoor styling.'
            ],
            [
                'name' => 'Vannak Chan',
                'role' => 'Plant Enthusiast',
                'rating' => 5,
                'comment' => 'Fast delivery and the care instructions included were super helpful. My Boston Fern is thriving beautifully!'
            ],
            [
                'name' => 'Dara Rath',
                'role' => 'Home Decorator',
                'rating' => 5,
                'comment' => 'Great prices, healthy plants, and fast response from their team. Will definitely order more plants for my apartment.'
            ],
        ];

        return view('home', compact('features', 'plants', 'reviews'));
    }
}
