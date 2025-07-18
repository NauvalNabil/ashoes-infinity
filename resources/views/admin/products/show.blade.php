@extends('admin.layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1 class="h2 mb-0" style="color: var(--primary-pink); font-weight: 700;">Product Details</h1>
        <p class="text-muted">View product information</p>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-pink me-2">
            <i class="fas fa-arrow-left me-2"></i>Back to Products
        </a>
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-pink">
            <i class="fas fa-edit me-2"></i>Edit Product
        </a>
    </div>
</div>

<div class="row">
    <!-- Product Images -->
    <div class="col-lg-6 mb-4">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-images me-2"></i>Product Images
                </h5>
            </div>
            <div class="card-body">
                @if($product->image)
                    <div class="mb-4">
                        <h6>Main Image</h6>
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="img-fluid rounded border border-pink"
                             style="max-width: 100%; height: 300px; object-fit: cover;">
                    </div>
                @endif
                
                @if($product->gallery && count($product->gallery) > 0)
                    <div>
                        <h6>Gallery Images</h6>
                        <div class="row g-3">
                            @foreach($product->gallery as $image)
                            <div class="col-6 col-md-4">
                                <img src="{{ asset('storage/' . $image) }}" 
                                     alt="Gallery Image" 
                                     class="img-fluid rounded border border-pink"
                                     style="aspect-ratio: 1; object-fit: cover; cursor: pointer;"
                                     data-bs-toggle="modal" 
                                     data-bs-target="#imageModal"
                                     data-image="{{ asset('storage/' . $image) }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @if(!$product->image && (!$product->gallery || count($product->gallery) === 0))
                    <div class="text-center py-5">
                        <i class="fas fa-image fa-3x mb-3" style="color: var(--primary-pink); opacity: 0.5;"></i>
                        <p class="text-muted">No images available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Product Information -->
    <div class="col-lg-6 mb-4">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Product Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Name:</strong></div>
                    <div class="col-sm-8">{{ $product->name }}</div>
                </div>
                
                @if($product->brand)
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Brand:</strong></div>
                    <div class="col-sm-8">{{ $product->brand }}</div>
                </div>
                @endif
                
                @if($product->category)
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Category:</strong></div>
                    <div class="col-sm-8">
                        <span class="badge bg-secondary">{{ ucfirst($product->category) }}</span>
                    </div>
                </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Price:</strong></div>
                    <div class="col-sm-8">
                        <span class="h5 text-success">${{ number_format($product->price, 2) }}</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Stock:</strong></div>
                    <div class="col-sm-8">
                        <span class="badge {{ $product->stock <= 0 ? 'bg-danger' : ($product->stock <= 10 ? 'bg-warning text-dark' : 'bg-success') }}">
                            {{ $product->stock }} units
                        </span>
                    </div>
                </div>
                
                @if($product->color)
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Color:</strong></div>
                    <div class="col-sm-8">{{ $product->color }}</div>
                </div>
                @endif
                
                @if($product->sizes && count($product->sizes) > 0)
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Sizes:</strong></div>
                    <div class="col-sm-8">
                        @foreach($product->sizes as $size)
                            <span class="badge bg-outline-pink me-1">{{ $size }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Status:</strong></div>
                    <div class="col-sm-8">
                        <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Created:</strong></div>
                    <div class="col-sm-8">{{ $product->created_at->format('M d, Y \a\t g:i A') }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Updated:</strong></div>
                    <div class="col-sm-8">{{ $product->updated_at->format('M d, Y \a\t g:i A') }}</div>
                </div>
                
                @if($product->description)
                <div class="row">
                    <div class="col-sm-12">
                        <strong>Description:</strong>
                        <div class="mt-2 p-3 rounded" style="background: var(--gray-light); border: 1px solid var(--border-pink);">
                            {{ $product->description }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-12 mb-4">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-tools me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-pink w-100">
                            <i class="fas fa-edit me-2"></i>Edit Product
                        </a>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('admin.products.update', $product) }}" method="POST" class="d-inline w-100">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="is_active" value="{{ $product->is_active ? '0' : '1' }}">
                            <button type="submit" class="btn {{ $product->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} w-100">
                                <i class="fas fa-{{ $product->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $product->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-info w-100" disabled>
                            <i class="fas fa-chart-line me-2"></i>View Analytics
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" 
                                class="btn btn-outline-danger w-100" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>Delete Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Information -->
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Product Statistics
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="stat-item p-3">
                            <h3 class="h4 mb-1" style="color: var(--primary-pink);">0</h3>
                            <p class="text-muted mb-0">Total Orders</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item p-3">
                            <h3 class="h4 mb-1" style="color: var(--primary-pink);">0</h3>
                            <p class="text-muted mb-0">Total Revenue</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item p-3">
                            <h3 class="h4 mb-1" style="color: var(--primary-pink);">0</h3>
                            <p class="text-muted mb-0">Views</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item p-3">
                            <h3 class="h4 mb-1" style="color: var(--primary-pink);">0</h3>
                            <p class="text-muted mb-0">Reviews</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Statistics will be available once the orders and analytics system is implemented.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark border border-pink">
            <div class="modal-header border-bottom border-pink">
                <h5 class="modal-title">Product Image</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Product Image" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark border border-pink">
            <div class="modal-header border-bottom border-pink">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the product: <strong>{{ $product->name }}</strong>?</p>
                <p class="text-warning">
                    <i class="fas fa-warning me-1"></i>
                    This action cannot be undone and will also delete all associated images.
                </p>
            </div>
            <div class="modal-footer border-top border-pink">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image modal
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        
        document.querySelectorAll('[data-bs-target="#imageModal"]').forEach(img => {
            img.addEventListener('click', function() {
                modalImage.src = this.dataset.image;
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    .stat-item {
        border-right: 1px solid var(--border-pink);
    }
    
    .stat-item:last-child {
        border-right: none;
    }
    
    .badge.bg-outline-pink {
        background: transparent !important;
        color: var(--primary-pink) !important;
        border: 1px solid var(--primary-pink);
    }
    
    @media (max-width: 768px) {
        .stat-item {
            border-right: none;
            border-bottom: 1px solid var(--border-pink);
        }
        
        .stat-item:last-child {
            border-bottom: none;
        }
    }
</style>
@endpush
