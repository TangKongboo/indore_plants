@extends('admin.layouts.admin')

@section('title', 'Order ' . $order->order_number . ' - Admin')
@section('page_title', 'Order: ' . $order->order_number)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Orders
    </a>
</div>

<div class="row g-4">
    <!-- Order Summary & Items -->
    <div class="col-lg-8">
        <div class="card card-custom p-4 mb-4">
            <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                <div>
                    <h5 class="fw-bold mb-1">Order #{{ $order->order_number }}</h5>
                    <span class="text-muted small">Placed on {{ $order->created_at->format('M d, Y - h:i A') }}</span>
                </div>
                <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill">{{ $order->order_status }}</span>
            </div>

            <!-- Items Table -->
            <h6 class="fw-bold mb-3">Items Ordered</h6>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if($item->plant)
                                        <img src="{{ $item->plant->image_url }}" alt="{{ $item->plant_name }}" width="44" height="44" class="rounded-2 border object-fit-cover">
                                    @else
                                        <div class="stat-icon bg-light text-muted" style="width: 44px; height: 44px;"><i class="fa-solid fa-seedling"></i></div>
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $item->plant_name }}</div>
                                        @if($item->plant && $item->plant->category)
                                            <span class="small text-muted">{{ $item->plant->category->name }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td class="fw-semibold">{{ $item->quantity }}</td>
                            <td class="text-end fw-bold">${{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-top">
                            <td colspan="3" class="text-end fw-bold fs-5">Total Amount:</td>
                            <td class="text-end fw-bold text-success fs-5">${{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @if($order->notes)
            <div class="mt-3 p-3 bg-light rounded-3 border">
                <strong><i class="fa-solid fa-note-sticky text-warning me-1"></i> Customer Note:</strong>
                <p class="mb-0 text-muted mt-1">{{ $order->notes }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Customer Info & Status Update Form -->
    <div class="col-lg-4">
        <!-- Customer Details Card -->
        <div class="card card-custom p-4 mb-4">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-user text-primary me-2"></i>Customer Info</h5>
            
            <div class="mb-2">
                <span class="text-muted small d-block">Full Name</span>
                <span class="fw-semibold">{{ $order->customer_name }}</span>
            </div>

            <div class="mb-2">
                <span class="text-muted small d-block">Phone Number</span>
                <span class="fw-semibold">{{ $order->customer_phone }}</span>
            </div>

            @if($order->customer_email)
            <div class="mb-2">
                <span class="text-muted small d-block">Email Address</span>
                <span class="fw-semibold">{{ $order->customer_email }}</span>
            </div>
            @endif

            <div class="mb-0">
                <span class="text-muted small d-block">Delivery Address</span>
                <span class="fw-semibold">{{ $order->customer_address }}</span>
            </div>
        </div>

        <!-- Order Management Card -->
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-sliders text-success me-2"></i>Update Status</h5>

            <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Order Fulfillment</label>
                    <select name="order_status" class="form-select">
                        <option value="Pending" {{ $order->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Processing" {{ $order->order_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Shipped" {{ $order->order_status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="Delivered" {{ $order->order_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Payment Status ({{ $order->payment_method }})</label>
                    <select name="payment_status" class="form-select">
                        <option value="Pending" {{ $order->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Failed" {{ $order->payment_status == 'Failed' ? 'selected' : '' }}>Failed</option>
                        <option value="Refunded" {{ $order->payment_status == 'Refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success text-white rounded-pill w-100 py-2">
                    <i class="fa-solid fa-arrows-rotate me-1"></i> Update Order Status
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
