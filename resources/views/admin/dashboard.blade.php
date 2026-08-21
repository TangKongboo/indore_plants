@extends('admin.layouts.admin')

@section('title', 'Admin Dashboard - IndorePlants')
@section('page_title', 'Overview & Analytics')

@section('content')
<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <!-- Total Plants -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Total Plants</span>
                    <h2 class="fw-bold mb-0 mt-1">{{ $totalPlants }}</h2>
                </div>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fa-solid fa-seedling"></i>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('admin.plants.index') }}" class="text-success small fw-semibold text-decoration-none">
                    View Catalog <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Categories -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Categories</span>
                    <h2 class="fw-bold mb-0 mt-1">{{ $totalCategories }}</h2>
                </div>
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('admin.categories.index') }}" class="text-warning small fw-semibold text-decoration-none">
                    Manage Groups <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Total Orders</span>
                    <h2 class="fw-bold mb-0 mt-1">{{ $totalOrders }}</h2>
                </div>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="badge bg-warning text-dark">{{ $pendingOrdersCount }} Pending</span>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Paid Revenue</span>
                    <h2 class="fw-bold mb-0 mt-1">${{ number_format($totalRevenue, 2) }}</h2>
                </div>
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="text-muted small">From online orders</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Revenue Chart -->
    <div class="col-lg-8">
        <div class="card card-custom p-4 h-100">
            <h5 class="fw-bold mb-4">Revenue (Last 7 Days)</h5>
            <canvas id="revenueChart" style="max-height: 300px;"></canvas>
        </div>
    </div>
    
    <!-- Category Chart -->
    <div class="col-lg-4">
        <div class="card card-custom p-4 h-100">
            <h5 class="fw-bold mb-4">Plants by Category</h5>
            <canvas id="categoryChart" style="max-height: 300px;"></canvas>
        </div>
    </div>
</div>

<!-- Quick Actions & Top Plants -->
<div class="row g-4 mb-4">
    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card card-custom p-4 h-100">
            <h5 class="fw-bold mb-3">Quick Actions</h5>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.plants.create') }}" class="btn btn-success text-white py-2 rounded-3 text-start d-flex align-items-center gap-2">
                    <i class="fa-solid fa-plus-circle"></i> Add New Plant to Catalog
                </a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light py-2 rounded-3 text-start d-flex align-items-center gap-2 border">
                    <i class="fa-solid fa-folder-plus text-warning"></i> Add / Edit Categories
                </a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-light py-2 rounded-3 text-start d-flex align-items-center gap-2 border">
                    <i class="fa-solid fa-truck-fast text-primary"></i> Process Customer Orders
                </a>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-light py-2 rounded-3 text-start d-flex align-items-center gap-2 border">
                    <i class="fa-solid fa-globe text-success"></i> Open Public Storefront
                </a>
            </div>
        </div>
    </div>

    <!-- Inventory Highlights -->
    <div class="col-lg-8">
        <div class="card card-custom p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0">Inventory Stock Overview</h5>
                <a href="{{ route('admin.plants.index') }}" class="btn btn-sm btn-outline-success rounded-pill">View All</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Plant</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topPlants as $plant)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $plant->image_url }}" alt="{{ $plant->name }}" width="36" height="36" class="rounded-2 border object-fit-cover">
                                    <span class="fw-semibold">{{ $plant->name }}</span>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $plant->category->name ?? 'General' }}</span></td>
                            <td class="fw-bold">${{ number_format($plant->price, 2) }}</td>
                            <td>
                                <span class="fw-semibold {{ $plant->stock <= 5 ? 'text-danger' : 'text-success' }}">
                                    {{ $plant->stock }} units
                                </span>
                            </td>
                            <td>
                                @if($plant->stock > 10)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill">In Stock</span>
                                @elseif($plant->stock > 0)
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1 rounded-pill">Low Stock</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1 rounded-pill">Out of Stock</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">No plants found in inventory.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="card card-custom p-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="fw-bold mb-0">Recent Customer Orders</h5>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All Orders</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td class="fw-bold text-primary">{{ $order->order_number }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td class="fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge {{ $order->payment_status === 'Paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $order->payment_status }} ({{ $order->payment_method }})
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 rounded-pill">
                            {{ $order->order_status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-light border rounded-pill px-3">
                            <i class="fa-solid fa-eye text-muted"></i> Details
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No recent orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revenue Line Chart
    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRevenue, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueLabels) !!},
            datasets: [{
                label: 'Revenue (USD)',
                data: {!! json_encode($revenueData) !!},
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Categories Doughnut Chart
    const ctxCat = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCat, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($catLabels) !!},
            datasets: [{
                data: {!! json_encode($catData) !!},
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
</script>
@endpush
@endsection
