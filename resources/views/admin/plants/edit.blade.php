@extends('admin.layouts.admin')

@section('title', 'Edit Plant - Admin')
@section('page_title', 'Edit Plant: ' . $plant->name)

@section('content')
<div class="card card-custom p-4" style="max-width: 900px;">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="fw-bold mb-0">Update Plant</h5>
        <a href="{{ route('admin.plants.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Catalog
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 border-0 mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.plants.update', $plant) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <!-- Current Image Preview -->
            <div class="col-12 mb-2">
                <label class="form-label fw-semibold d-block">Current Image</label>
                <img src="{{ $plant->image_url }}" alt="{{ $plant->name }}" width="90" height="90" class="rounded-3 border object-fit-cover shadow-sm">
            </div>

            <!-- Plant Name -->
            <div class="col-md-8">
                <label class="form-label fw-semibold">Plant Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $plant->name) }}" required>
            </div>

            <!-- Category -->
            <div class="col-md-4">
                <label class="form-label fw-semibold">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $plant->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Price -->
            <div class="col-md-4">
                <label class="form-label fw-semibold">Price ($) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $plant->price) }}" required>
            </div>

            <!-- Stock -->
            <div class="col-md-4">
                <label class="form-label fw-semibold">Stock Quantity <span class="text-danger">*</span></label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $plant->stock) }}" required>
            </div>

            <!-- Rating -->
            <div class="col-md-4">
                <label class="form-label fw-semibold">Rating (1 - 5)</label>
                <select name="rating" class="form-select">
                    @for($r = 5; $r >= 1; $r--)
                        <option value="{{ $r }}" {{ old('rating', $plant->rating) == $r ? 'selected' : '' }}>{{ $r }} Stars</option>
                    @endfor
                </select>
            </div>

            <!-- Location / Origin -->
            <div class="col-md-6">
                <label class="form-label fw-semibold">Location / Origin</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $plant->location) }}">
            </div>

            <!-- Highlight Badge -->
            <div class="col-md-6">
                <label class="form-label fw-semibold">Highlight Badge</label>
                <input type="text" name="badge" class="form-control" value="{{ old('badge', $plant->badge) }}">
            </div>

            <!-- Light Requirement -->
            <div class="col-md-6">
                <label class="form-label fw-semibold">Light Requirement</label>
                <input type="text" name="light_level" class="form-control" value="{{ old('light_level', $plant->light_level) }}">
            </div>

            <!-- Water Frequency -->
            <div class="col-md-6">
                <label class="form-label fw-semibold">Water Frequency</label>
                <input type="text" name="water_frequency" class="form-control" value="{{ old('water_frequency', $plant->water_frequency) }}">
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $plant->description) }}</textarea>
            </div>

            <!-- Change Image Upload or Select -->
            <div class="col-md-6">
                <label class="form-label fw-semibold">Upload New Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Leave empty to keep current image</small>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Or Switch to Preset Image</label>
                <select name="image_select" class="form-select">
                    <option value="">-- Keep current ({{ $plant->image }}) --</option>
                    <option value="cart-1.png">cart-1.png (Boston Fern / Potted)</option>
                    <option value="plant-1.png">plant-1.png (Large Indoor Fig)</option>
                    <option value="plant-2.png">plant-2.png (Lush Green Table Plant)</option>
                    <option value="home.png">home.png (Hero Monster Plant)</option>
                </select>
            </div>

            <!-- Toggles -->
            <div class="col-12 mt-3">
                <div class="d-flex gap-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_pet_friendly" id="petFriendly" value="1" {{ old('is_pet_friendly', $plant->is_pet_friendly) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="petFriendly">🐾 Pet Friendly</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="featuredPlant" value="1" {{ old('is_featured', $plant->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="featuredPlant">⭐ Featured on Homepage</label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="col-12 mt-4 pt-3 border-top d-flex gap-3">
                <button type="submit" class="btn btn-success text-white rounded-pill px-4">
                    <i class="fa-solid fa-save me-1"></i> Update Plant
                </button>
                <a href="{{ route('admin.plants.index') }}" class="btn btn-light border rounded-pill px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
