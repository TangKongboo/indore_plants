@extends('layouts.app')

@section('title', 'My Account & Orders - IndorePlants')

@section('content')
<div class="container py-5">
    <!-- Account Header -->
    <div class="row align-items-center mb-4">
        <div class="col-md-8">
            <div class="d-flex align-items-center gap-3">
                <div class="reviewer-avatar" style="width: 60px; height: 60px; font-size: 1.8rem;">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1">Hello, {{ $user->name }}!</h2>
                    <span class="text-muted small"><i class="fa-solid fa-envelope me-1"></i>{{ $user->email }}</span>
                    @if($user->phone)
                        <span class="text-muted small ms-3"><i class="fa-solid fa-phone me-1"></i>{{ $user->phone }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                    <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Sign Out
                </button>
            </form>
        </div>
    </div>

    <!-- Orders Section -->
    <div class="row g-4">
        <div class="col-12">
            <div class="plant-card p-4 rounded-4 border">
                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom border-secondary border-opacity-25 pb-3">
                    <h4 class="fw-bold mb-0"><i class="fa-solid fa-box-open text-warning me-2"></i>My Order History</h4>
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">{{ $orders->total() }} Total Orders</span>
                </div>

                @forelse($orders as $order)
                <div class="p-4 mb-4 rounded-4 border border-secondary border-opacity-25" style="background: rgba(0,0,0,0.25);">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 border-bottom border-secondary border-opacity-25 pb-3">
                        <div>
                            <span class="text-warning fw-bold fs-5 me-2">Order #{{ $order->order_number }}</span>
                            <span class="text-muted small">Placed on {{ $order->created_at->format('M d, Y - h:i A') }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            @php
                                $statusBadges = [
                                    'Pending' => 'bg-warning text-dark',
                                    'Processing' => 'bg-info text-dark',
                                    'Shipped' => 'bg-primary text-white',
                                    'Delivered' => 'bg-success text-white',
                                    'Cancelled' => 'bg-danger text-white',
                                ];
                            @endphp
                            <span class="badge {{ $statusBadges[$order->order_status] ?? 'bg-secondary' }} px-3 py-2 rounded-pill">
                                {{ $order->order_status }}
                            </span>
                            <span class="badge bg-dark border border-secondary px-3 py-2 rounded-pill">
                                {{ $order->payment_status }} ({{ $order->payment_method }})
                            </span>
                        </div>
                    </div>

                    <!-- Visual Order Tracker -->
                    @php
                        $progressMap = [
                            'Pending' => 1,
                            'Processing' => 2,
                            'Shipped' => 3,
                            'Delivered' => 4,
                            'Cancelled' => -1
                        ];
                        $currentStep = $progressMap[$order->order_status] ?? 1;
                    @endphp

                    @if($currentStep > 0)
                        <div class="position-relative m-4 d-none d-md-block">
                            <!-- Background Track -->
                            <div class="progress" style="height: 4px; background-color: rgba(255,255,255,0.1);">
                                <!-- Active Progress -->
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($currentStep - 1) * 33.33 }}%; transition: width 0.5s ease;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            
                            <!-- Steps -->
                            <div class="d-flex justify-content-between position-absolute top-50 start-0 w-100 translate-middle-y">
                                <!-- Step 1 -->
                                <div class="text-center" style="width: 2rem;">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white {{ $currentStep >= 1 ? 'bg-success shadow' : 'bg-dark border border-secondary text-muted' }}" style="width: 32px; height: 32px; margin: 0 auto;">
                                        <i class="fa-solid fa-clipboard-list small"></i>
                                    </div>
                                    <div class="small fw-bold mt-2 {{ $currentStep >= 1 ? 'text-success' : 'text-muted' }}" style="position: absolute; left: 0; transform: translateX(-25%); width: 80px;">Pending</div>
                                </div>
                                
                                <!-- Step 2 -->
                                <div class="text-center" style="width: 2rem;">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white {{ $currentStep >= 2 ? 'bg-success shadow' : 'bg-dark border border-secondary text-muted' }}" style="width: 32px; height: 32px; margin: 0 auto;">
                                        <i class="fa-solid fa-box-open small"></i>
                                    </div>
                                    <div class="small fw-bold mt-2 {{ $currentStep >= 2 ? 'text-success' : 'text-muted' }}" style="position: absolute; left: 33.33%; transform: translateX(-50%); width: 80px;">Processing</div>
                                </div>

                                <!-- Step 3 -->
                                <div class="text-center" style="width: 2rem;">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white {{ $currentStep >= 3 ? 'bg-success shadow' : 'bg-dark border border-secondary text-muted' }}" style="width: 32px; height: 32px; margin: 0 auto;">
                                        <i class="fa-solid fa-truck-fast small"></i>
                                    </div>
                                    <div class="small fw-bold mt-2 {{ $currentStep >= 3 ? 'text-success' : 'text-muted' }}" style="position: absolute; left: 66.66%; transform: translateX(-50%); width: 80px;">Shipped</div>
                                </div>

                                <!-- Step 4 -->
                                <div class="text-center" style="width: 2rem;">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white {{ $currentStep >= 4 ? 'bg-success shadow' : 'bg-dark border border-secondary text-muted' }}" style="width: 32px; height: 32px; margin: 0 auto;">
                                        <i class="fa-solid fa-house-circle-check small"></i>
                                    </div>
                                    <div class="small fw-bold mt-2 {{ $currentStep >= 4 ? 'text-success' : 'text-muted' }}" style="position: absolute; right: 0; transform: translateX(25%); width: 80px;">Delivered</div>
                                </div>
                            </div>
                        </div>
                        <!-- Spacer for mobile/desktop layout -->
                        <div class="mb-5 d-none d-md-block"></div>
                    @endif

                    <!-- Items Grid -->
                    <div class="row g-3">
                        @foreach($order->items as $item)
                        <div class="col-md-6 col-12">
                            <div class="d-flex align-items-center gap-3 p-2 rounded-3" style="background: rgba(255,255,255,0.05);">
                                @if($item->plant)
                                    <img src="{{ $item->plant->image_url }}" alt="{{ $item->plant_name }}" width="50" height="50" class="rounded-2 border object-fit-cover">
                                @else
                                    <div class="reviewer-avatar" style="width: 50px; height: 50px;"><i class="fa-solid fa-seedling"></i></div>
                                @endif
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ $item->plant_name }}</div>
                                    <span class="text-muted small">Qty: {{ $item->quantity }} × ${{ number_format($item->unit_price, 2) }}</span>
                                </div>
                                <span class="fw-bold text-warning">${{ number_format($item->subtotal, 2) }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Delivery Destination & Total -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mt-3 pt-3 border-top border-secondary border-opacity-25">
                        <div class="small text-muted">
                            <i class="fa-solid fa-location-dot text-danger me-1"></i> Delivery: {{ $order->customer_address }}
                        </div>
                        <div class="text-end">
                            <span class="text-muted small me-2">Total Paid:</span>
                            <span class="fs-5 fw-bold text-white">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="fa-solid fa-cart-arrow-down fs-1 mb-3 text-warning opacity-75"></i>
                    <h5>No orders found under this account yet.</h5>
                    <p class="small text-muted mb-4">Discover our collection of fresh indoor plants!</p>
                    <a href="{{ route('home') }}#popular" class="btn btn-hero-primary px-4 py-2">
                        Explore Plants Now
                    </a>
                </div>
                @endforelse

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
