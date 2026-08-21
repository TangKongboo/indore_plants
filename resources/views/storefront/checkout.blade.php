@extends('layouts.app')

@section('title', 'Secure Checkout - IndorePlants')

@section('content')
<div class="container py-5">
    <div class="mb-4 text-center">
        <h1 class="font-lobster-title">Secure Checkout</h1>
        <p class="text-muted">Complete your order for fresh indoor plants.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-3 border-0 py-2 small mb-4 mx-auto" style="max-width: 800px;">
            <i class="fa-solid fa-triangle-exclamation me-1"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="row g-5 justify-content-center">
            
            <!-- Delivery Details -->
            <div class="col-lg-7">
                <div class="plant-card p-4 rounded-4 border">
                    <h4 class="fw-bold text-white mb-4"><i class="fa-solid fa-truck text-gold me-2"></i>Delivery Details</h4>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-soft small fw-semibold">Full Name *</label>
                            <input type="text" name="customer_name" class="form-control bg-dark border-secondary text-white" value="{{ auth()->check() ? auth()->user()->name : old('customer_name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-soft small fw-semibold">Email Address *</label>
                            <input type="email" name="customer_email" class="form-control bg-dark border-secondary text-white" value="{{ auth()->check() ? auth()->user()->email : old('customer_email') }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label text-soft small fw-semibold">Phone Number *</label>
                            <input type="text" name="customer_phone" class="form-control bg-dark border-secondary text-white" value="{{ auth()->check() ? auth()->user()->phone : old('customer_phone') }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label text-soft small fw-semibold">Full Delivery Address (Street, City, Province) *</label>
                            <textarea name="customer_address" class="form-control bg-dark border-secondary text-white" rows="3" required>{{ auth()->check() ? auth()->user()->address : old('customer_address') }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label text-soft small fw-semibold">Order Notes (Optional)</label>
                            <textarea name="notes" class="form-control bg-dark border-secondary text-white" rows="2" placeholder="e.g. Please leave at the front door">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="plant-card p-4 rounded-4 border mt-4">
                    <h4 class="fw-bold text-white mb-4"><i class="fa-solid fa-wallet text-gold me-2"></i>Payment Method</h4>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="radio" class="btn-check" name="payment_method" id="pay-cod" value="cod" autocomplete="off" checked>
                            <label class="btn btn-outline-warning w-100 p-3 rounded-3 d-flex flex-column align-items-center gap-2 border-secondary" for="pay-cod" style="transition: var(--transition-smooth);">
                                <i class="fa-solid fa-hand-holding-dollar fs-3"></i>
                                <span class="fw-bold">Cash on Delivery</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" class="btn-check" name="payment_method" id="pay-khqr" value="khqr" autocomplete="off">
                            <label class="btn btn-outline-warning w-100 p-3 rounded-3 d-flex flex-column align-items-center gap-2 border-secondary" for="pay-khqr" style="transition: var(--transition-smooth);">
                                <i class="fa-solid fa-qrcode fs-3"></i>
                                <span class="fw-bold">Pay with KHQR</span>
                            </label>
                        </div>
                    </div>

                    <!-- KHQR Mock Image (Hidden by default) -->
                    <div id="khqr-container" class="mt-4 text-center d-none p-3 bg-white rounded-3">
                        <h6 class="text-dark fw-bold mb-2">Scan to Pay with ABA / KHQR</h6>
                        <div class="bg-light border p-2 d-inline-block rounded">
                            <!-- Placeholder QR code -->
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=indoreplants_mock_qr_{{ $total }}" alt="KHQR Code" width="200" height="200">
                        </div>
                        <p class="text-muted small mt-2 mb-0">Total: <strong>${{ number_format($total, 2) }}</strong></p>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-5">
                <div class="plant-card p-4 rounded-4 border sticky-top" style="top: 100px;">
                    <h4 class="fw-bold text-white mb-4">Order Summary</h4>
                    
                    <div class="d-flex flex-column gap-3 mb-4 max-h-300 overflow-auto pe-2">
                        @foreach($cart as $item)
                        <div class="d-flex gap-3 align-items-center">
                            <img src="{{ $item['image'] }}" class="rounded-2 object-fit-cover border border-secondary border-opacity-25" width="60" height="60" alt="{{ $item['name'] }}">
                            <div class="flex-grow-1">
                                <h6 class="text-white mb-0">{{ $item['name'] }}</h6>
                                <div class="text-muted small">Qty: {{ $item['quantity'] }}</div>
                            </div>
                            <div class="text-white fw-bold">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-top border-secondary border-opacity-25 pt-3 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span class="text-white">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping</span>
                            <span class="text-success fw-bold">FREE</span>
                        </div>
                        <div class="d-flex justify-content-between mt-3 pt-3 border-top border-secondary border-opacity-25">
                            <span class="text-white fw-bold fs-5">Total</span>
                            <span class="text-gold fw-bold fs-5">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="auth-btn-submit w-100 py-3 mt-2 fs-5">
                        <i class="fa-solid fa-lock me-2"></i> Complete Order
                    </button>
                    
                    <div class="text-center mt-3">
                        <i class="fa-solid fa-shield-halved text-success"></i> <span class="text-muted small">100% Secure Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('styles')
<style>
    .btn-check:checked + .btn-outline-warning {
        background-color: rgba(234, 179, 8, 0.1);
        border-color: var(--accent-yellow) !important;
        color: var(--accent-yellow);
        box-shadow: 0 0 0 2px rgba(234, 179, 8, 0.5);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const codRadio = document.getElementById('pay-cod');
        const khqrRadio = document.getElementById('pay-khqr');
        const khqrContainer = document.getElementById('khqr-container');

        khqrRadio.addEventListener('change', function() {
            if(this.checked) {
                khqrContainer.classList.remove('d-none');
            }
        });

        codRadio.addEventListener('change', function() {
            if(this.checked) {
                khqrContainer.classList.add('d-none');
            }
        });
    });
</script>
@endpush
@endsection
