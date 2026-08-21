<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantStoreController extends Controller
{
    public function show($slug)
    {
        $plant = Plant::where('slug', $slug)->firstOrFail();
        
        // Get 4 related plants from the same category (excluding current)
        $relatedPlants = Plant::where('category_id', $plant->category_id)
            ->where('id', '!=', $plant->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('storefront.plant-detail', compact('plant', 'relatedPlants'));
    }
}
