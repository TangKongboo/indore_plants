@extends('admin.layouts.admin')

@section('title', 'Plants Catalog - Admin')
@section('page_title', 'Plants Catalog')

@section('content')
<div class="card card-custom p-4">
    <!-- Header with Search, Filter & Add Button -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <form action="{{ route('admin.plants.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1">
            <div class="input-group" style="max-width: 320px;">
                <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="Search plant name..." value="{{ request('search') }}">
            </div>

            <select name="category_id" class="form-select" style="max-width: 200px;" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            @if(request('search') || request('category_id'))
                <a href="{{ route('admin.plants.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>

        <a href="{{ route('admin.plants.create') }}" class="btn btn-success text-white rounded-pill px-4 d-inline-flex align-items-center gap-2">
            <i class="fa-solid fa-plus"></i> Add New Plant
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Light / Water</th>
                    <th>Badge</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plants as $plant)
                <tr>
                    <td>{{ $plant->id }}</td>
                    <td>
                        <img src="{{ $plant->image_url }}" alt="{{ $plant->name }}" width="48" height="48" class="rounded-3 border object-fit-cover">
                    </td>
                    <td>
                        <div class="fw-bold">{{ $plant->name }}</div>
                        <span class="small text-muted"><i class="fa-solid fa-location-dot me-1"></i>{{ $plant->location }}</span>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border">{{ $plant->category->name ?? 'None' }}</span>
                    </td>
                    <td class="fw-bold">${{ number_format($plant->price, 2) }}</td>
                    <td>
                        <span class="fw-semibold {{ $plant->stock <= 5 ? 'text-danger' : 'text-success' }}">
                            {{ $plant->stock }}
                        </span>
                    </td>
                    <td>
                        <div class="small"><i class="fa-solid fa-sun text-warning me-1"></i>{{ $plant->light_level }}</div>
                        <div class="small text-muted"><i class="fa-solid fa-droplet text-info me-1"></i>{{ $plant->water_frequency }}</div>
                    </td>
                    <td>
                        @if($plant->badge)
                            <span class="badge bg-warning text-dark">{{ $plant->badge }}</span>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.plants.edit', $plant) }}" class="btn btn-sm btn-outline-primary" title="Edit Plant">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.plants.destroy', $plant) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this plant?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Plant">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-5 text-muted">
                        <i class="fa-solid fa-seedling fs-1 mb-2 text-secondary opacity-50"></i>
                        <p class="mb-0">No plants match your search or filter.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $plants->links() }}
    </div>
</div>
@endsection
