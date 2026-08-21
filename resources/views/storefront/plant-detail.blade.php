@extends('layouts.app')

@section('title', $plant->name . ' - IndorePlants')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home') }}#popular" class="text-decoration-none text-muted">Plants</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">{{ $plant->name }}</li>
        </ol>
    </nav>

    <!-- Product Section -->
    <div class="row g-5 mb-5 pb-4 border-bottom border-secondary border-opacity-25">
        <!-- Image Gallery -->
        <div class="col-lg-5 col-md-6">
            <div class="position-relative rounded-4 overflow-hidden border border-secondary border-opacity-25 bg-dark d-flex align-items-center justify-content-center" style="aspect-ratio: 4/5;">
                @if($plant->badge)
                    <span class="position-absolute top-0 start-0 m-3 badge bg-warning text-dark px-3 py-2 rounded-pill shadow">
                        {{ $plant->badge }}
                    </span>
                @endif
                <img src="{{ $plant->image_url }}" alt="{{ $plant->name }}" class="img-fluid object-fit-cover w-100 h-100">
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-7 col-md-6">
            <div class="mb-2">
                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill small">
                    {{ $plant->category->name ?? 'Indoor' }}
                </span>
            </div>
            <h1 class="font-outfit fw-bold text-white mb-2" style="font-size: 2.5rem;">{{ $plant->name }}</h1>
            
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="text-warning">
                    @for ($s = 0; $s < $plant->rating; $s++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <span class="text-muted small">|</span>
                <span class="text-soft small"><i class="fa-solid fa-location-dot me-1"></i> {{ $plant->location }}</span>
            </div>

            <h2 class="text-gold fw-bold mb-4">${{ number_format($plant->price, 2) }}</h2>

            <p class="text-muted lh-lg mb-4">
                {{ $plant->description ?: 'A beautiful indoor plant perfect for adding a touch of nature to your living space. Hand-selected for health and vibrance.' }}
            </p>

            <!-- Care Requirements -->
            <div class="row g-3 mb-5">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);">
                        <div class="text-warning fs-3"><i class="fa-solid fa-sun"></i></div>
                        <div>
                            <div class="small text-muted mb-1">Sunlight</div>
                            <div class="fw-semibold text-white small">{{ $plant->light_level }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);">
                        <div class="text-info fs-3"><i class="fa-solid fa-droplet"></i></div>
                        <div>
                            <div class="small text-muted mb-1">Watering</div>
                            <div class="fw-semibold text-white small">{{ $plant->water_frequency }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);">
                        <div class="{{ $plant->is_pet_friendly ? 'text-success' : 'text-danger' }} fs-3"><i class="fa-solid fa-paw"></i></div>
                        <div>
                            <div class="small text-muted mb-1">Toxicity</div>
                            <div class="fw-semibold text-white small">
                                {{ $plant->is_pet_friendly ? '100% Pet Friendly (Safe for Cats & Dogs)' : 'Toxic to pets if ingested. Keep out of reach.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add to Cart Action -->
            <div class="d-flex flex-wrap align-items-center gap-3">
                <div class="d-flex align-items-center bg-dark border border-secondary border-opacity-50 rounded-pill overflow-hidden" style="height: 50px;">
                    <button class="btn btn-link text-white text-decoration-none px-3 border-0" onclick="decrementQty()"><i class="fa-solid fa-minus"></i></button>
                    <input type="number" id="qty-input" value="1" min="1" max="{{ $plant->stock }}" class="form-control bg-transparent border-0 text-center text-white p-0 fw-bold" style="width: 50px; box-shadow: none;">
                    <button class="btn btn-link text-white text-decoration-none px-3 border-0" onclick="incrementQty()"><i class="fa-solid fa-plus"></i></button>
                </div>
                
                <button class="auth-btn-submit flex-grow-1" style="height: 50px; max-width: 300px;" onclick="addToCart({{ $plant->id }})">
                    <i class="fa-solid fa-cart-shopping me-2"></i> <span>Add to Cart</span>
                </button>
            </div>
            
            @if($plant->stock < 5)
                <div class="text-danger small mt-3 fw-semibold">
                    <i class="fa-solid fa-fire me-1"></i> Only {{ $plant->stock }} left in stock!
                </div>
            @else
                <div class="text-success small mt-3 fw-semibold">
                    <i class="fa-solid fa-check me-1"></i> In Stock & Ready to Ship
                </div>
            @endif
        </div>
    </div>

    <!-- Related Plants -->
    @if($relatedPlants->count() > 0)
    <div class="mt-5">
        <h3 class="font-lobster-title fs-2 mb-4">You May Also Like</h3>
        <div class="row g-4">
            @foreach ($relatedPlants as $relPlant)
            <div class="col-lg-3 col-md-6 col-12">
                <a href="{{ route('plant.show', $relPlant->slug) }}" class="text-decoration-none">
                    <div class="plant-card h-100 d-flex flex-column justify-content-between transition-hover">
                        <div>
                            @if($relPlant->badge)
                                <span class="plant-badge">{{ $relPlant->badge }}</span>
                            @endif

                            <div class="plant-img-wrapper">
                                <img src="{{ $relPlant->image_url }}" alt="{{ $relPlant->name }}">
                            </div>

                            <span class="plant-category">{{ $relPlant->category->name ?? 'Indoor' }}</span>
                            <h3 class="plant-title text-white">{{ $relPlant->name }}</h3>

                            <div class="star-rating">
                                @for ($s = 0; $s < $relPlant->rating; $s++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>
                        </div>

                        <div class="plant-footer mt-3">
                            <span class="plant-price">${{ number_format($relPlant->price, 2) }}</span>
                            <button class="btn-add-cart" aria-label="Add to cart" onclick="event.preventDefault(); addToCart({{ $relPlant->id }})">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
    function incrementQty() {
        let input = document.getElementById('qty-input');
        if (parseInt(input.value) < parseInt(input.max)) {
            input.value = parseInt(input.value) + 1;
        }
    }

    function decrementQty() {
        let input = document.getElementById('qty-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function addToCart(plantId) {
        let qty = document.getElementById('qty-input') ? document.getElementById('qty-input').value : 1;
        // TO-DO: Implement AJAX call to cart controller in Phase 2
        alert('Item added to cart! (Cart UI coming in Phase 2)');
    }
</script>
@endpush
@endsection
