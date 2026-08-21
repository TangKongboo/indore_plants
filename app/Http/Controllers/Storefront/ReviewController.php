<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Plant $plant)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'plant_id' => $plant->id,
            'reviewer_name' => auth()->user()->name,
            'reviewer_role' => auth()->user()->role == 'admin' ? 'Staff' : 'Customer',
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true, // Auto-approve for demo purposes
        ]);

        // Update the average rating on the plant
        $averageRating = Review::where('plant_id', $plant->id)->where('is_approved', true)->avg('rating');
        $plant->update(['rating' => round($averageRating)]);

        return redirect()->back()->with('success', 'Thank you! Your review has been submitted.');
    }
}
