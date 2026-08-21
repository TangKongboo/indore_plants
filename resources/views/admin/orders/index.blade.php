@extends('admin.layouts.admin')

@section('title', 'Customer Orders - Admin')
@section('page_title', 'Customer Orders')

@section('content')
<div class="card card-custom p-4">
    <!-- Filters & Search -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1">
            <div class="input-group" style="max-width: 320px;">
                <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="Search order #, customer, phone..." value="{{ request('search') }}">
            </div>

            <select name="status" class="form-select" style="max-width: 180px;" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Processing" {{ request('status') == 'Processing' ? 'selected' : '' }}>Processing</option>
                <option value="Shipped" {{ request('status') == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            @if(request('search') || request('status'))
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>

    <!-- Orders Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Order #</th>
                    <th>Customer Name</th>
                    <th>Contact Info</th>
                    <th>Items Ordered</th>
                    <th>Total Amount</th>
                    <th>Payment</th>
                    <th>Order Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="fw-bold text-primary">{{ $order->order_number }}</td>
                    <td><span class="fw-semibold">{{ $order->customer_name }}</span></td>
                    <td>
                        <div class="small"><i class="fa-solid fa-phone me-1 text-muted"></i>{{ $order->customer_phone }}</div>
                        @if($order->customer_email)
                            <div class="small text-muted"><i class="fa-solid fa-envelope me-1"></i>{{ $order->customer_email }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border">
                            {{ $order->items->count() }} items ({{ $order->items->sum('quantity') }} plants)
                        </span>
                    </td>
                    <td class="fw-bold fs-6">${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge {{ $order->payment_status === 'Paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $order->payment_status }} ({{ $order->payment_method }})
                        </span>
                    </td>
                    <td>
                        @php
                            $statusColors = [
                                'Pending' => 'bg-warning text-dark',
                                'Processing' => 'bg-info text-dark',
                                'Shipped' => 'bg-primary',
                                'Delivered' => 'bg-success',
                                'Cancelled' => 'bg-danger',
                            ];
                        @endphp
                        <span class="badge {{ $statusColors[$order->order_status] ?? 'bg-secondary' }} px-3 py-1 rounded-pill">
                            {{ $order->order_status }}
                        </span>
                    </td>
                    <td class="small text-muted">{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary" title="View Order">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Order">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-5 text-muted">
                        <i class="fa-solid fa-cart-shopping fs-1 mb-2 text-secondary opacity-50"></i>
                        <p class="mb-0">No orders found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
