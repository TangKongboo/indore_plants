@extends('layouts.app')

@section('title', 'Shop All Plants - IndorePlants')

@section('content')
<div class="container py-5">
    <div class="row mb-5 align-items-center">
        <div class="col-md-6">
            <h1 class="font-lobster-title fs-1 mb-1">Our Green Collection</h1>
            <p class="text-muted">Explore our hand-picked selection of indoor plants</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <span class="text-white fw-bold">{{ $plants->total() }}</span> <span class="text-muted small">plants found</span>
        </div>
    </div>

    <div class="row g-5">
        <!-- Mobile Filter Toggle -->
        <div class="d-lg-none mb-3">
            <button class="btn btn-outline-warning w-100 d-flex align-items-center justify-content-center gap-2 py-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">
                <i class="fa-solid fa-filter"></i> Show Filters
            </button>
        </div>

        <!-- Smart Filters Sidebar (Offcanvas on mobile) -->
        <div class="col-lg-3">
            <div class="offcanvas-lg offcanvas-start bg-dark border-end border-secondary border-opacity-25" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
                <style>
                    @media (min-width: 992px) {
                        #filterOffcanvas {
                            background-color: transparent !important;
                            border: none !important;
                        }
                    }
                </style>
                <div class="offcanvas-header border-bottom border-secondary border-opacity-25 d-lg-none">
                    <h5 class="offcanvas-title text-white fw-bold" id="filterOffcanvasLabel"><i class="fa-solid fa-filter text-gold me-2"></i> Filters</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" data-bs-target="#filterOffcanvas" aria-label="Close"></button>
                </div>
                
                <div class="offcanvas-body d-block pt-4 pt-lg-0">
                    <div class="plant-card p-4 rounded-4 border sticky-top w-100" style="top: 100px;">
                        <h5 class="font-outfit fw-bold text-white mb-4 d-none d-lg-block"><i class="fa-solid fa-filter text-gold me-2"></i> Filters</h5>
                        
                        <form action="{{ route('shop') }}" method="GET">
                            @if(request('q'))
                                <input type="hidden" name="q" value="{{ request('q') }}">
                            @endif
                            
                            <!-- Categories -->
                            <div class="mb-4">
                                <h6 class="text-white small fw-bold text-uppercase mb-3">Categories</h6>
                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input border-secondary" type="radio" name="category" value="" id="cat-all" {{ !request('category') ? 'checked' : '' }}>
                                        <label class="form-check-label text-soft small" for="cat-all">All Categories</label>
                                    </div>
                                    @foreach($categories as $cat)
                                    <div class="form-check">
                                        <input class="form-check-input border-secondary" type="radio" name="category" value="{{ $cat->slug }}" id="cat-{{ $cat->id }}" {{ request('category') == $cat->slug ? 'checked' : '' }}>
                                        <label class="form-check-label text-soft small" for="cat-{{ $cat->id }}">{{ $cat->name }} <span class="text-muted">({{ $cat->plants_count }})</span></label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Sunlight -->
                            <div class="mb-4 pt-4 border-top border-secondary border-opacity-25">
                                <h6 class="text-white small fw-bold text-uppercase mb-3">Sunlight Needs</h6>
                                <select name="light" class="form-select bg-dark text-white border-secondary small shadow-none">
                                    <option value="">Any Light Level</option>
                                    <option value="Low Light" {{ request('light') == 'Low Light' ? 'selected' : '' }}>Low Light</option>
                                    <option value="Indirect" {{ request('light') == 'Indirect' ? 'selected' : '' }}>Bright Indirect</option>
                                    <option value="Direct" {{ request('light') == 'Direct' ? 'selected' : '' }}>Direct Sunlight</option>
                                </select>
                            </div>

                            <!-- Pet Friendly -->
                            <div class="mb-4 pt-4 border-top border-secondary border-opacity-25">
                                <div class="form-check form-switch d-flex align-items-center gap-2">
                                    <input class="form-check-input shadow-none m-0" type="checkbox" name="pet_friendly" id="petFriendly" value="1" {{ request('pet_friendly') ? 'checked' : '' }}>
                                    <label class="form-check-label text-white small fw-bold" for="petFriendly"><i class="fa-solid fa-paw text-success me-1"></i> 100% Pet Safe Only</label>
                                </div>
                            </div>
                            
                            <button type="submit" class="auth-btn-submit w-100 py-2 mt-2">
                                Apply Filters
                            </button>
                            @if(request()->hasAny(['category', 'light', 'pet_friendly', 'q']))
                                <a href="{{ route('shop') }}" class="btn btn-outline-secondary w-100 mt-2 small">Clear All</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plants Grid -->
        <div class="col-lg-9">
            <div class="row g-3 g-lg-4">
                @forelse ($plants as $plant)
                <div class="col-6 col-md-4">
                    <a href="{{ route('plant.show', $plant->slug) }}" class="text-decoration-none text-white">
                        <div class="plant-card h-100 d-flex flex-column justify-content-between transition-hover p-2 p-md-3">
                            <div>
                                @if($plant->badge)
                                    <span class="plant-badge small">{{ $plant->badge }}</span>
                                @endif

                                <div class="plant-img-wrapper position-relative catalog-img-wrapper">
                                    <button class="btn btn-sm btn-dark bg-opacity-75 position-absolute top-0 end-0 m-2 rounded-circle z-3 shadow text-danger border-0 transition-hover" onclick="event.preventDefault(); toggleWishlist({{ $plant->id }}, this)" style="width: 32px; height: 32px; padding: 0;">
                                        @if(auth()->check() && auth()->user()->wishlists()->where('plant_id', $plant->id)->exists())
                                            <i class="fa-solid fa-heart"></i>
                                        @else
                                            <i class="fa-regular fa-heart"></i>
                                        @endif
                                    </button>
                                    <img src="{{ $plant->image_url }}" alt="{{ $plant->name }}">
                                </div>

                                <span class="plant-category small">{{ $plant->category->name ?? 'Indoor' }}</span>
                                <h3 class="plant-title text-white fs-6 fs-md-5">{{ $plant->name }}</h3>

                                <div class="small text-muted mb-3 mt-1 mt-md-2" style="font-size: 0.75rem;">
                                    <div><i class="fa-solid fa-sun text-warning me-1"></i> {{ $plant->light_level }}</div>
                                    @if($plant->is_pet_friendly)
                                        <div class="text-success mt-1"><i class="fa-solid fa-paw me-1"></i> Pet Safe</div>
                                    @endif
                                </div>
                            </div>

                            <div class="plant-footer mt-auto pt-3 border-top border-secondary border-opacity-25">
                                <span class="plant-price">${{ number_format($plant->price, 2) }}</span>
                                <button class="btn-add-cart" aria-label="Add to cart" onclick="event.preventDefault(); addToCart({{ $plant->id }})">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-seedling fs-1 text-muted opacity-50 mb-3"></i>
                    <h5 class="text-white">No plants match your filters</h5>
                    <p class="text-muted">Try adjusting your search criteria or clearing filters.</p>
                    <a href="{{ route('shop') }}" class="btn btn-outline-warning mt-3">Clear Filters</a>
                </div>
                @endforelse
            </div>
            
            <div class="mt-5 d-flex justify-content-center">
                {{ $plants->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
