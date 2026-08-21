@extends('admin.layouts.admin')

@section('title', 'Categories Management - Admin')
@section('page_title', 'Plant Categories')

@section('content')
<div class="row g-4">
    <!-- Add Category Form Card -->
    <div class="col-lg-4">
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-plus-circle text-success me-2"></i>Create Category</h5>
            
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Air Purifier, Succulents" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">FontAwesome Icon Class</label>
                    <input type="text" name="icon" class="form-control" value="fa-seedling" placeholder="e.g. fa-wind, fa-tree, fa-sun">
                    <small class="text-muted">Example: fa-wind, fa-tree, fa-sun, fa-moon</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Category purpose or tips..."></textarea>
                </div>

                <button type="submit" class="btn btn-success text-white rounded-pill w-100 py-2">
                    <i class="fa-solid fa-check me-1"></i> Save Category
                </button>
            </form>
        </div>
    </div>

    <!-- Category List Table -->
    <div class="col-lg-8">
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3">Existing Categories ({{ count($categories) }})</h5>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Plants Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>
                                <div class="stat-icon bg-success bg-opacity-10 text-success" style="width: 38px; height: 38px; font-size: 1.1rem;">
                                    <i class="fa-solid {{ $category->icon ?: 'fa-seedling' }}"></i>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $category->name }}</div>
                                <div class="small text-muted">{{ Str::limit($category->description, 45) }}</div>
                            </td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 py-1 rounded-pill">
                                    {{ $category->plants_count }} Plants
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Edit Modal Trigger -->
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}" title="Edit Category">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Category" {{ $category->plants_count > 0 ? 'disabled' : '' }}>
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Edit Category: {{ $category->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Category Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Icon Class</label>
                                                        <input type="text" name="icon" class="form-control" value="{{ $category->icon }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Description</label>
                                                        <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success text-white rounded-pill px-4">Update Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No categories created yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
