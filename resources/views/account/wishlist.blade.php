@extends('layouts.app')

@section('title', 'My Wishlist - IndorePlants')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="list-group rounded-4 shadow-sm border border-secondary border-opacity-25">
                <a href="{{ route('account.orders') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary border-opacity-25 py-3">
                    <i class="fa-solid fa-box text-warning me-2"></i> My Orders
                </a>
                <a href="{{ route('account.wishlist') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary border-opacity-25 py-3 active bg-opacity-50">
                    <i class="fa-solid fa-heart text-danger me-2"></i> My Wishlist
                </a>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="list-group-item list-group-item-action bg-dark text-danger border-secondary border-opacity-25 py-3 rounded-bottom-4">
                        <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="plant-card p-4 p-md-5 rounded-4 border border-secondary border-opacity-25">
                <h3 class="font-lobster-title fs-2 mb-4">My Wishlist</h3>
                
                @if($wishlists->count() > 0)
                    <div class="row g-4">
                        @foreach($wishlists as $item)
                        <div class="col-md-4 col-sm-6" id="wishlist-item-{{ $item->plant->id }}">
                            <a href="{{ route('plant.show', $item->plant->slug) }}" class="text-decoration-none text-white">
                                <div class="plant-card h-100 d-flex flex-column justify-content-between transition-hover border border-secondary border-opacity-25 p-3 rounded-4 bg-dark">
                                    <div class="position-relative">
                                        <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle z-3 shadow" onclick="event.preventDefault(); toggleWishlist({{ $item->plant->id }}, this)" style="width: 32px; height: 32px; padding: 0;">
                                            <i class="fa-solid fa-trash-can small"></i>
                                        </button>
                                        <div class="plant-img-wrapper rounded-3 mb-3" style="height: 180px;">
                                            <img src="{{ $item->plant->image_url }}" alt="{{ $item->plant->name }}">
                                        </div>
                                        <h5 class="text-white mb-1">{{ $item->plant->name }}</h5>
                                        <div class="text-gold fw-bold mb-2">${{ number_format($item->plant->price, 2) }}</div>
                                    </div>
                                    <button class="btn btn-outline-warning w-100 mt-2" onclick="event.preventDefault(); addToCart({{ $item->plant->id }})">
                                        <i class="fa-solid fa-cart-plus me-1"></i> Add to Cart
                                    </button>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fa-regular fa-heart fs-1 text-secondary opacity-50 mb-3"></i>
                        <h5 class="text-white mb-2">Your wishlist is empty</h5>
                        <p class="text-muted mb-4">Save your favorite plants here for later.</p>
                        <a href="{{ route('shop') }}" class="btn btn-outline-warning">Explore Plants</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
