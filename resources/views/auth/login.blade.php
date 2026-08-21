@extends('layouts.app')

@section('title', 'Sign In - IndorePlants')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 col-12">
            <div class="plant-card p-4 p-md-5 rounded-4 shadow-lg border">
                <!-- Header -->
                <div class="text-center mb-4">
                    <img src="{{ asset('favicon.svg') }}" alt="IndorePlants" width="56" height="56" class="logo-badge mb-3">
                    <h2 class="font-lobster-title fs-2 mb-1">Welcome Back</h2>
                    <p class="text-muted small">Sign in to manage your orders or access admin dashboard</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger rounded-3 border-0 py-2 small mb-4">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i> {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success rounded-3 border-0 py-2 small mb-4">
                        <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-white">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                        </div>
                        @error('email')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-white">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" class="form-control bg-dark text-white border-secondary @error('password') is-invalid @enderror" placeholder="••••••••" required>
                        </div>
                        @error('password')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted small" for="remember">Remember me</label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-hero-primary w-100 justify-content-center py-2 mb-3">
                        <i class="fa-solid fa-right-to-bracket me-2"></i> Sign In
                    </button>
                </form>

                <!-- Demo Credentials Box -->
                <div class="p-3 mt-3 rounded-3 border border-secondary border-opacity-25" style="background: rgba(0,0,0,0.25);">
                    <span class="text-warning small fw-bold d-block mb-1"><i class="fa-solid fa-key me-1"></i> Demo Credentials:</span>
                    <div class="small text-muted mb-1">
                        <strong>Admin:</strong> <code>admin@indoreplants.com</code> / <code>admin123</code>
                    </div>
                    <div class="small text-muted">
                        <strong>Customer:</strong> <code>customer@indoreplants.com</code> / <code>customer123</code>
                    </div>
                </div>

                <!-- Footer link -->
                <div class="text-center mt-4 pt-3 border-top border-secondary border-opacity-25">
                    <span class="text-muted small">Don't have an account yet?</span>
                    <a href="{{ route('register') }}" class="text-warning fw-semibold small ms-1 text-decoration-none">Create Account</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
