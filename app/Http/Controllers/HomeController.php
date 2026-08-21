<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Plant;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the application home page with live database records.
     */
    public function index(Request $request)
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

        $categories = Category::where('is_active', true)->withCount('plants')->get();

        $plantQuery = Plant::with('category');

        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            $plantQuery->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $plants = $plantQuery->latest()->get();
        $reviews = Review::where('is_approved', true)->latest()->take(4)->get();

        return view('home', compact('features', 'categories', 'plants', 'reviews'));
    }
}
