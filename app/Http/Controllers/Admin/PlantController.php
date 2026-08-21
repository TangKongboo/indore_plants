<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlantController extends Controller
{
    public function index(Request $request)
    {
        $query = Plant::with('category');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $plants = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.plants.index', compact('plants', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.plants.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'rating' => 'required|integer|min:1|max:5',
            'location' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:100',
            'light_level' => 'nullable|string|max:255',
            'water_frequency' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_pet_friendly' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'image_select' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . rand(100, 999);
        $validated['is_pet_friendly'] = $request->has('is_pet_friendly');
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        } elseif ($request->filled('image_select')) {
            $validated['image'] = $request->input('image_select');
        } else {
            $validated['image'] = 'cart-1.png';
        }

        Plant::create($validated);

        return redirect()->route('admin.plants.index')->with('success', 'Plant added successfully!');
    }

    public function edit(Plant $plant)
    {
        $categories = Category::all();
        return view('admin.plants.edit', compact('plant', 'categories'));
    }

    public function update(Request $request, Plant $plant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'rating' => 'required|integer|min:1|max:5',
            'location' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:100',
            'light_level' => 'nullable|string|max:255',
            'water_frequency' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_pet_friendly' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'image_select' => 'nullable|string',
        ]);

        $validated['is_pet_friendly'] = $request->has('is_pet_friendly');
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        } elseif ($request->filled('image_select')) {
            $validated['image'] = $request->input('image_select');
        }

        $plant->update($validated);

        return redirect()->route('admin.plants.index')->with('success', 'Plant updated successfully!');
    }

    public function destroy(Plant $plant)
    {
        $plant->delete();
        return redirect()->route('admin.plants.index')->with('success', 'Plant deleted successfully!');
    }
}
