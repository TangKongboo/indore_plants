@extends('layouts.app')

@section('title', 'Sign Up & Register - IndorePlants')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11 col-12">
                <div class="auth-card-container">
                    <div class="row g-0">
                        <!-- Left Side: Brand Showcase & Benefits -->
                        <div class="col-lg-5 auth-brand-side d-none d-lg-flex">
                            <div>
                                <a href="{{ route('home') }}" class="d-inline-flex align-items-center gap-2 mb-4 text-decoration-none">
                                    <img src="{{ asset('favicon.svg') }}" alt="IndorePlants" width="44" height="44" class="logo-badge">
                                    <span class="fs-4 fw-bold text-white font-outfit">Indore<span class="text-gold">Plants</span></span>
                                </a>

                                <h3 class="fw-bold text-white mb-3">Bring Nature Closer to Your Daily Life</h3>
                                <p class="text-soft small mb-4">
                                    Join thousands of plant parents across Cambodia and cultivate your own flourishing indoor oasis.
                                </p>

                                <div class="mt-4">
                                    <div class="auth-benefit-item">
                                        <div class="auth-benefit-icon">
                                            <i class="fa-solid fa-truck-fast"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-white mb-1">Live Order Tracking</h6>
                                            <p class="text-muted small mb-0">Follow your plant's journey from nursery to your doorstep.</p>
                                        </div>
                                    </div>

                                    <div class="auth-benefit-item">
                                        <div class="auth-benefit-icon">
                                            <i class="fa-solid fa-droplet"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-white mb-1">Botanical Care Reminders</h6>
                                            <p class="text-muted small mb-0">Personalized watering and sunlight care guidance.</p>
                                        </div>
                                    </div>

                                    <div class="auth-benefit-item">
                                        <div class="auth-benefit-icon">
                                            <i class="fa-solid fa-shield-heart"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-white mb-1">30-Day Plant Guarantee</h6>
                                            <p class="text-muted small mb-0">Every plant arrives healthy, vibrant, and potted in rich soil.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 mt-4 border-top border-white border-opacity-10">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="reviewer-avatar" style="width: 40px; height: 40px; font-size: 1.1rem;">
                                        <i class="fa-solid fa-star text-gold"></i>
                                    </div>
                                    <div class="small">
                                        <div class="text-white fw-bold">Rated 4.9/5 by 1,200+ Plant Lovers</div>
                                        <div class="text-muted">Cambodia's premier indoor plant service</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Register Form -->
                        <div class="col-lg-7 auth-form-side">
                            <div class="mb-4">
                                <span class="badge-tag mb-2">
                                    <i class="fa-solid fa-sparkles"></i> New Membership
                                </span>
                                <h2 class="fw-bold text-white font-outfit mb-1">Create Your Account</h2>
                                <p class="text-muted small">Sign up in seconds to start ordering plants with ease</p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger rounded-3 border-0 py-2 small mb-4">
                                    <i class="fa-solid fa-triangle-exclamation me-1"></i>
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form action="{{ route('register') }}" method="POST">
                                @csrf

                                <!-- Full Name -->
                                <div class="auth-input-group">
                                    <label class="auth-label">
                                        <i class="fa-solid fa-user text-gold"></i> Full Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="auth-input-wrapper">
                                        <i class="fa-solid fa-signature auth-input-icon"></i>
                                        <input type="text" name="name" class="auth-form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Kongboo Tang" required autofocus>
                                    </div>
                                </div>

                                <!-- Email Address -->
                                <div class="auth-input-group">
                                    <label class="auth-label">
                                        <i class="fa-solid fa-envelope text-gold"></i> Email Address <span class="text-danger">*</span>
                                    </label>
                                    <div class="auth-input-wrapper">
                                        <i class="fa-solid fa-at auth-input-icon"></i>
                                        <input type="email" name="email" class="auth-form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="name@example.com" required>
                                    </div>
                                </div>

                                <!-- Phone & City / Location -->
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="auth-input-group">
                                            <label class="auth-label">
                                                <i class="fa-solid fa-phone text-gold"></i> Phone Number
                                            </label>
                                            <div class="auth-input-wrapper">
                                                <i class="fa-solid fa-phone auth-input-icon"></i>
                                                <input type="text" name="phone" class="auth-form-control" value="{{ old('phone') }}" placeholder="+855 12 345 678">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="auth-input-group">
                                            <label class="auth-label">
                                                <i class="fa-solid fa-location-dot text-gold"></i> Delivery Location
                                            </label>
                                            <div class="auth-input-wrapper">
                                                <i class="fa-solid fa-city auth-input-icon"></i>
                                                <input type="text" name="address" class="auth-form-control" value="{{ old('address') }}" placeholder="Phnom Penh, Cambodia">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password & Confirmation -->
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="auth-input-group">
                                            <label class="auth-label">
                                                <i class="fa-solid fa-lock text-gold"></i> Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="auth-input-wrapper">
                                                <i class="fa-solid fa-key auth-input-icon"></i>
                                                <input type="password" name="password" class="auth-form-control @error('password') is-invalid @enderror" placeholder="Min. 6 characters" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="auth-input-group">
                                            <label class="auth-label">
                                                <i class="fa-solid fa-shield-check text-gold"></i> Confirm Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="auth-input-wrapper">
                                                <i class="fa-solid fa-check-double auth-input-icon"></i>
                                                <input type="password" name="password_confirmation" class="auth-form-control" placeholder="Repeat password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <i class="fa-solid fa-circle-check text-emerald small"></i>
                                    <span class="text-muted small">By registering, you agree to our plant health & privacy terms.</span>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="auth-btn-submit">
                                    <span>Create My Account</span> <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </form>

                            <!-- Sign In Link -->
                            <div class="text-center mt-4 pt-3 border-top border-white border-opacity-10">
                                <span class="text-muted small">Already have an IndorePlants account?</span>
                                <a href="{{ route('login') }}" class="text-gold fw-bold small ms-1 text-decoration-none">
                                    Sign In Here <i class="fa-solid fa-chevron-right small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
