@extends('layouts.app')

@section('title', 'IndorePlants - Bring Nature Into Your Environment')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 col-12">
                <div class="badge-tag">
                    <i class="fa-solid fa-leaf"></i> Premium Indoor Collection
                </div>
                <h1 class="hero-title">
                    Plants make a <span class="text-normal">positive impact</span> on your environment.
                </h1>
                <p class="hero-description">
                    Transform your indoor spaces into healthy green sanctuaries. Explore our hand-picked selection of low-maintenance, air-purifying, and elegant indoor plants delivered directly to your doorstep.
                </p>
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <a href="#popular" class="btn btn-hero-primary">
                        Shop Now <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="#about" class="btn btn-hero-secondary">
                        Know More <i class="fa-solid fa-circle-info"></i>
                    </a>
                </div>

                <div class="socialmedia-icon-wrapper">
                    <span class="text-muted fs-6 me-2">Follow Us:</span>
                    <a href="#" class="socialmedia-icon-1" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="socialmedia-icon-1" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class="socialmedia-icon-1" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="socialmedia-icon-1" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-12 text-center">
                <div class="hero-img-container">
                    <img src="{{ asset('images/home.png') }}" alt="IndorePlants Hero" class="img-fluid" style="max-height: 520px;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="row g-4">
            @foreach ($features as $feature)
            <div class="col-lg-3 col-md-6 col-12">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fa-solid {{ $feature['icon'] }}"></i>
                    </div>
                    <h3 class="feature-title">{{ $feature['title'] }}</h3>
                    <p class="feature-desc mb-0">{{ $feature['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about" class="about-section position-relative">
    <div class="container">
        <div class="text-center mb-5 position-relative">
            <img class="position-absolute end-0 d-none d-md-block opacity-75" style="top: -20px;" src="{{ asset('images/leaf-3.png') }}" alt="Leaf Decor" width="120">
            <h2 class="font-lobster-title">About Us</h2>
            <p class="p-text">Dedicated to bringing nature closer to your everyday life</p>
        </div>

        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6 col-12">
                <div class="about-card">
                    <span class="font-card-1">Make your </span>
                    <span class="text-normal font-card-1">organic</span><br>
                    <span class="font-card-1">garden at home</span>
                    <p class="font-lobster mt-4 fs-6 lh-lg text-muted">
                        We believe that living with plants improves mental wellness, purifies air quality, and creates a relaxing home atmosphere. Our team curates the healthiest indoor plants adapted for tropical indoor growth.
                    </p>
                    <div class="d-flex gap-4 mt-4">
                        <div>
                            <h3 class="fw-bold text-normal mb-0">500+</h3>
                            <span class="small text-muted">Plant Varieties</span>
                        </div>
                        <div class="border-start ps-4">
                            <h3 class="fw-bold text-normal mb-0">99%</h3>
                            <span class="small text-muted">Happy Customers</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 text-center">
                <img src="{{ asset('images/plant-1.png') }}" alt="Organic Garden Plant" class="img-fluid rounded-4 shadow-lg" style="max-height: 420px; object-fit: cover;">
            </div>
        </div>

        <div class="row g-5 align-items-center flex-row-reverse">
            <div class="col-lg-6 col-12">
                <div class="about-card">
                    <span class="font-card-1">Come with us & </span><br>
                    <span class="text-normal font-card-1">grow up </span>
                    <span class="font-card-1">your green space</span>
                    <p class="font-lobster mt-4 fs-6 lh-lg text-muted">
                        Whether you are a seasoned plant parent or just beginning your green journey, we provide comprehensive plant care guidance, eco-friendly soil mixes, and continuous support.
                    </p>
                    <a href="#popular" class="btn btn-hero-primary mt-3">
                        Discover Plants <i class="fa-solid fa-seedling"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-12 text-center">
                <img src="{{ asset('images/plant-2.png') }}" alt="Grown Up Garden" class="img-fluid rounded-4 shadow-lg" style="max-height: 420px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<!-- Choice Plants (Product Catalog) -->
<section id="popular" class="catalog-section">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="font-lobster-title">Your Choice Plants</h2>
            <p class="p-text">Hand-picked best-selling indoor plants for your living space</p>
        </div>

        <!-- Dynamic Category Filter Tabs -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
            <a href="{{ route('home') }}#popular" class="btn {{ !request('category') ? 'btn-warning text-dark fw-bold' : 'btn-outline-light' }} rounded-pill px-4 py-2">
                All Plants ({{ \App\Models\Plant::count() }})
            </a>
            @foreach ($categories as $cat)
            <a href="{{ route('home', ['category' => $cat->slug]) }}#popular" class="btn {{ request('category') == $cat->slug ? 'btn-warning text-dark fw-bold' : 'btn-outline-light' }} rounded-pill px-4 py-2">
                <i class="fa-solid {{ $cat->icon }} me-1"></i> {{ $cat->name }} ({{ $cat->plants_count }})
            </a>
            @endforeach
        </div>

        <!-- Plants Grid -->
        <div class="row g-4">
            @forelse ($plants as $plant)
            <div class="col-lg-3 col-md-6 col-12">
                <div class="plant-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        @if($plant->badge)
                            <span class="plant-badge">{{ $plant->badge }}</span>
                        @endif

                        <div class="plant-img-wrapper">
                            <img src="{{ $plant->image_url }}" alt="{{ $plant->name }}">
                        </div>

                        <span class="plant-category">{{ $plant->category->name ?? 'Indoor' }}</span>
                        <h3 class="plant-title">{{ $plant->name }}</h3>

                        <div class="star-rating">
                            @for ($s = 0; $s < $plant->rating; $s++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            <span class="text-muted ms-1 fs-6">({{ $plant->location }})</span>
                        </div>

                        <div class="small text-muted mb-3">
                            <div><i class="fa-solid fa-sun text-warning me-1"></i> {{ $plant->light_level }}</div>
                            <div><i class="fa-solid fa-droplet text-info me-1"></i> {{ $plant->water_frequency }}</div>
                        </div>
                    </div>

                    <div class="plant-footer">
                        <span class="plant-price">${{ number_format($plant->price, 2) }}</span>
                        <button class="btn-add-cart" aria-label="Add to cart" title="Add to cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 text-white-50">
                <i class="fa-solid fa-seedling fs-1 mb-3 text-warning"></i>
                <h4>No plants found in this category.</h4>
                <a href="{{ route('home') }}#popular" class="btn btn-warning rounded-pill px-4 mt-2">View All Plants</a>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Customer Reviews Section -->
<section id="reviews" class="reviews-section">
    <div class="container">
        <div class="text-center mb-5 position-relative">
            <img class="position-absolute start-0 d-none d-md-block opacity-75" style="top: -20px;" src="{{ asset('images/leaf-4.png') }}" alt="Leaf Decor" width="120">
            <h2 class="font-lobster-title">Customer Reviews</h2>
            <p class="p-text">See what plant lovers say about their experience with us</p>
        </div>

        <div class="row g-4">
            @foreach ($reviews as $review)
            <div class="col-lg-3 col-md-6 col-12">
                <div class="review-card">
                    <div>
                        <i class="fa-solid fa-quote-left quote-icon"></i>
                        <p class="review-comment">"{{ $review->comment }}"</p>
                    </div>
                    <div class="reviewer-profile">
                        <div class="reviewer-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div>
                            <h4 class="reviewer-name">{{ $review->reviewer_name }}</h4>
                            <span class="reviewer-role">{{ $review->reviewer_role }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection