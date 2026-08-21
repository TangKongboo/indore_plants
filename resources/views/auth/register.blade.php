@extends('layouts.app')

@section('title', 'Create Account - IndorePlants')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-12">
            <div class="plant-card p-4 p-md-5 rounded-4 shadow-lg border">
                <!-- Header -->
                <div class="text-center mb-4">
                    <img src="{{ asset('favicon.svg') }}" alt="IndorePlants" width="56" height="56" class="logo-badge mb-3">
                    <h2 class="font-lobster-title fs-2 mb-1">Join IndorePlants</h2>
                    <p class="text-muted small">Create an account to track your plant orders & get botanical tips</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-white">Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="name" class="form-control bg-dark text-white border-secondary @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Kongboo Tang" required autofocus>
                        </div>
                        @error('name')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-white">Email Address <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="name@example.com" required>
                        </div>
                        @error('email')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone Number & Delivery Address -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-white">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-phone"></i></span>
                                <input type="text" name="phone" class="form-control bg-dark text-white border-secondary @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="+855 ...">
                            </div>
                            @error('phone')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-white">City / Location</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-location-dot"></i></span>
                                <input type="text" name="address" class="form-control bg-dark text-white border-secondary @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Phnom Penh">
                            </div>
                            @error('address')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-white">Password (min 6 characters) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" class="form-control bg-dark text-white border-secondary @error('password') is-invalid @enderror" placeholder="••••••••" required>
                        </div>
                        @error('password')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-white">Confirm Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-shield"></i></span>
                            <input type="password" name="password_confirmation" class="form-control bg-dark text-white border-secondary" placeholder="••••••••" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-hero-primary w-100 justify-content-center py-2 mb-3">
                        <i class="fa-solid fa-user-plus me-2"></i> Register Account
                    </button>
                </form>

                <!-- Footer link -->
                <div class="text-center mt-4 pt-3 border-top border-secondary border-opacity-25">
                    <span class="text-muted small">Already have an account?</span>
                    <a href="{{ route('login') }}" class="text-warning fw-semibold small ms-1 text-decoration-none">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
