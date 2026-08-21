<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Plant::query();

        // Filters
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('light')) {
            $query->where('light_level', 'like', '%' . $request->light . '%');
        }

        if ($request->filled('pet_friendly')) {
            $query->where('is_pet_friendly', 1);
        }
        
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Search text
        if ($request->filled('q')) {
            $searchTerm = '%' . $request->q . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm);
            });
        }

        $plants = $query->with('category')->paginate(12)->withQueryString();
        $categories = Category::withCount('plants')->get();

        return view('storefront.catalog', compact('plants', 'categories'));
    }

    public function apiSearch(Request $request)
    {
        $q = $request->q;
        if (empty($q) || strlen($q) < 2) {
            return response()->json([]);
        }

        $plants = Plant::where('name', 'like', "%{$q}%")
            ->select('id', 'name', 'slug', 'price', 'image', 'category_id')
            ->with('category:id,name')
            ->take(5)
            ->get();
            
        $results = $plants->map(function($plant) {
            return [
                'name' => $plant->name,
                'url' => route('plant.show', $plant->slug),
                'image' => $plant->image_url,
                'price' => '$' . number_format($plant->price, 2),
                'category' => $plant->category->name ?? 'Indoor'
            ];
        });

        return response()->json($results);
    }
}
