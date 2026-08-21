@extends('layouts.app')

@section('title', 'Sign In - IndorePlants')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10 col-12">
                <div class="auth-card-container">
                    <div class="row g-0">
                        <!-- Left Side: Brand Showcase & Welcome -->
                        <div class="col-lg-5 auth-brand-side d-none d-lg-flex">
                            <div>
                                <a href="{{ route('home') }}" class="d-inline-flex align-items-center gap-2 mb-4 text-decoration-none">
                                    <img src="{{ asset('favicon.svg') }}" alt="IndorePlants" width="44" height="44" class="logo-badge">
                                    <span class="fs-4 fw-bold text-white font-outfit">Indore<span class="text-gold">Plants</span></span>
                                </a>

                                <h3 class="fw-bold text-white mb-3">Welcome Back to Your Garden</h3>
                                <p class="text-soft small mb-4">
                                    Sign in to view your past orders, manage your indoor greenery collection, or access the admin management portal.
                                </p>

                                <div class="mt-4">
                                    <div class="auth-benefit-item">
                                        <div class="auth-benefit-icon">
                                            <i class="fa-solid fa-leaf"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-white mb-1">Easy Order Reordering</h6>
                                            <p class="text-muted small mb-0">Re-order organic plant fertilizer and pots in 1 click.</p>
                                        </div>
                                    </div>

                                    <div class="auth-benefit-item">
                                        <div class="auth-benefit-icon">
                                            <i class="fa-solid fa-gauge-high"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-white mb-1">Admin Management Access</h6>
                                            <p class="text-muted small mb-0">Direct access to the store management dashboard.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Demo Credentials Box -->
                            <div class="auth-demo-badge">
                                <span class="text-gold small fw-bold d-block mb-1">
                                    <i class="fa-solid fa-key me-1"></i> Quick Demo Access:
                                </span>
                                <div class="small text-muted mb-1">
                                    <strong class="text-white">Admin:</strong> <code>admin@indoreplants.com</code> / <code>admin123</code>
                                </div>
                                <div class="small text-muted">
                                    <strong class="text-white">Customer:</strong> <code>customer@indoreplants.com</code> / <code>customer123</code>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Login Form -->
                        <div class="col-lg-7 auth-form-side">
                            <div class="mb-4">
                                <span class="badge-tag mb-2">
                                    <i class="fa-solid fa-user-lock"></i> Account Sign In
                                </span>
                                <h2 class="fw-bold text-white font-outfit mb-1">Sign In to IndorePlants</h2>
                                <p class="text-muted small">Enter your login credentials to continue</p>
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

                            @if ($errors->any())
                                <div class="alert alert-danger rounded-3 border-0 py-2 small mb-4">
                                    <i class="fa-solid fa-triangle-exclamation me-1"></i>
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <!-- Email -->
                                <div class="auth-input-group">
                                    <label class="auth-label">
                                        <i class="fa-solid fa-envelope text-gold"></i> Email Address
                                    </label>
                                    <div class="auth-input-wrapper">
                                        <i class="fa-solid fa-at auth-input-icon"></i>
                                        <input type="email" name="email" class="auth-form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="auth-input-group">
                                    <label class="auth-label">
                                        <i class="fa-solid fa-lock text-gold"></i> Password
                                    </label>
                                    <div class="auth-input-wrapper">
                                        <i class="fa-solid fa-key auth-input-icon"></i>
                                        <input type="password" name="password" class="auth-form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                                    </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-soft small" for="remember">Keep me signed in</label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="auth-btn-submit">
                                    <span>Sign In to Account</span> <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                </button>
                            </form>

                            <!-- Mobile Demo Credentials Hint -->
                            <div class="d-lg-none mt-4">
                                <div class="auth-demo-badge">
                                    <span class="text-gold small fw-bold d-block mb-1">
                                        <i class="fa-solid fa-key me-1"></i> Demo Credentials:
                                    </span>
                                    <div class="small text-muted mb-1">
                                        <strong class="text-white">Admin:</strong> <code>admin@indoreplants.com</code> / <code>admin123</code>
                                    </div>
                                    <div class="small text-muted">
                                        <strong class="text-white">Customer:</strong> <code>customer@indoreplants.com</code> / <code>customer123</code>
                                    </div>
                                </div>
                            </div>

                            <!-- Register Link -->
                            <div class="text-center mt-4 pt-3 border-top border-white border-opacity-10">
                                <span class="text-muted small">New to IndorePlants?</span>
                                <a href="{{ route('register') }}" class="text-gold fw-bold small ms-1 text-decoration-none">
                                    Create an Account <i class="fa-solid fa-chevron-right small"></i>
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
