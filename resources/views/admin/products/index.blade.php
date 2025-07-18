@extends('admin.layouts.app')

@section('title', 'Products Management')

@section('content')
<div class="products-management">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Products Management</h1>
            <p class="page-subtitle">Manage your product inventory and track performance</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add New Product
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <form method="GET" action="{{ route('admin.products.index') }}" class="filters-form">
            <div class="filters-grid">
                <div class="filter-group">
                    <input type="text" 
                           class="form-control" 
                           name="search" 
                           placeholder="Search products..." 
                           value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <select class="form-select" name="category">
                        <option value="">All Categories</option>
                        <option value="men" {{ request('category') == 'men' ? 'selected' : '' }}>Men</option>
                        <option value="women" {{ request('category') == 'women' ? 'selected' : '' }}>Women</option>
                        <option value="sports" {{ request('category') == 'sports' ? 'selected' : '' }}>Sports</option>
                        <option value="casual" {{ request('category') == 'casual' ? 'selected' : '' }}>Casual</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-select" name="status">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-select" name="stock">
                        <option value="">All Stock</option>
                        <option value="low" {{ request('stock') == 'low' ? 'selected' : '' }}>Low Stock (≤10)</option>
                        <option value="out" {{ request('stock') == 'out' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="fas fa-search"></i>
                        Filter
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i>
                        Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    <div class="products-section">
        <div class="section-header">
            <h2 class="section-title">Products List</h2>
            <div class="section-meta">
                <span class="results-count">{{ $products->total() }} products found</span>
            </div>
        </div>

        @if($products->count() > 0)
            <div class="products-table">
                <div class="table-header">
                    <div class="header-cell">Product</div>
                    <div class="header-cell">Price</div>
                    <div class="header-cell">Stock</div>
                    <div class="header-cell">Status</div>
                    <div class="header-cell">Created</div>
                    <div class="header-cell">Actions</div>
                </div>

                @foreach($products as $product)
                <div class="table-row">
                    <div class="cell product-cell">
                        <div class="product-info">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="product-image">
                            @else
                                <div class="product-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                            <div class="product-details">
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="product-meta">
                                    @if($product->brand)
                                        <span class="product-brand">{{ $product->brand }}</span>
                                    @endif
                                    @if($product->category)
                                        <span class="product-category">{{ ucfirst($product->category) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell price-cell">
                        <span class="price">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <div class="cell stock-cell">
                        <span class="stock-badge {{ $product->stock <= 10 ? 'stock-low' : ($product->stock == 0 ? 'stock-out' : 'stock-good') }}">
                            {{ $product->stock }}
                        </span>
                    </div>
                    <div class="cell status-cell">
                        <div class="status-toggle">
                            <form method="POST" action="{{ route('admin.products.toggle-status', $product) }}" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="status-badge {{ $product->is_active ? 'status-active' : 'status-inactive' }}"
                                        title="Click to toggle status">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="cell date-cell">
                        <span class="date">{{ $product->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="cell actions-cell">
                        <div class="action-buttons">
                            <a href="{{ route('admin.products.show', $product) }}" 
                               class="action-btn view-btn" 
                               title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" 
                               class="action-btn edit-btn" 
                               title="Edit Product">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" 
                                  action="{{ route('admin.products.destroy', $product) }}" 
                                  style="display: inline;" 
                                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="action-btn delete-btn" 
                                        title="Delete Product">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="pagination-section">
                {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-3x mb-3" style="color: var(--primary-pink); opacity: 0.5;"></i>
                        <h5>No products found</h5>
                        <p class="text-muted">
                            @if(request()->hasAny(['search', 'category', 'status', 'stock']))
                                Try adjusting your filters or <a href="{{ route('admin.products.index') }}" class="text-pink">clear all filters</a>
                            @else
                                Start by adding your first product to get started
                            @endif
                        </p>
                        @unless(request()->hasAny(['search', 'category', 'status', 'stock']))
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Add Your First Product
                            </a>
                        @endunless
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Delete Modal
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const productNameSpan = document.getElementById('productName');
        
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const productName = this.dataset.productName;
                
                deleteForm.action = `{{ route('admin.products.index') }}/${productId}`;
                productNameSpan.textContent = productName;
            });
        });
        
        // Status Toggle
        document.querySelectorAll('.status-toggle').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const productId = this.dataset.productId;
                const isActive = this.checked;
                
                fetch(`{{ route('admin.products.index') }}/${productId}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ is_active: isActive })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        const alert = document.createElement('div');
                        alert.className = 'alert alert-success alert-dismissible fade show';
                        alert.innerHTML = `
                            ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        `;
                        document.querySelector('.admin-content').insertBefore(alert, document.querySelector('.admin-content').firstChild);
                        
                        // Auto hide after 3 seconds
                        setTimeout(() => {
                            const bsAlert = new bootstrap.Alert(alert);
                            bsAlert.close();
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Revert toggle on error
                    this.checked = !isActive;
                });
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Products Management Styles */
    .products-management {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    /* Page Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #374151;
    }
    
    .page-title {
        font-size: 2rem;
        font-weight: 600;
        color: #ffffff;
        margin: 0;
        line-height: 1.2;
    }
    
    .page-subtitle {
        color: #9ca3af;
        margin: 0.5rem 0 0 0;
        font-size: 0.95rem;
    }
    
    .header-actions {
        display: flex;
        gap: 1rem;
    }
    
    /* Filters Section */
    .filters-section {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .filters-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 1rem;
        align-items: end;
    }
    
    .filter-group {
        display: flex;
        flex-direction: column;
    }
    
    .filter-actions {
        display: flex;
        gap: 0.75rem;
    }
    
    /* Products Section */
    .products-section {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #374151;
        background: #111827;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #ffffff;
        margin: 0;
    }
    
    .results-count {
        color: #9ca3af;
        font-size: 0.875rem;
    }
    
    /* Products Table */
    .products-table {
        width: 100%;
    }
    
    .table-header {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1.5fr;
        gap: 1rem;
        padding: 1rem 2rem;
        background: #111827;
        border-bottom: 1px solid #374151;
    }
    
    .header-cell {
        color: #9ca3af;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .table-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1.5fr;
        gap: 1rem;
        padding: 1rem 2rem;
        border-bottom: 1px solid #2d3748;
        transition: background-color 0.2s ease;
    }
    
    .table-row:hover {
        background: rgba(55, 65, 81, 0.3);
    }
    
    .table-row:last-child {
        border-bottom: none;
    }
    
    .cell {
        display: flex;
        align-items: center;
    }
    
    /* Product Cell */
    .product-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .product-image {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
    }
    
    .product-placeholder {
        width: 50px;
        height: 50px;
        background: #374151;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
    }
    
    .product-name {
        color: #ffffff;
        font-weight: 500;
        margin-bottom: 0.25rem;
        line-height: 1.3;
    }
    
    .product-meta {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .product-brand, .product-category {
        color: #9ca3af;
        font-size: 0.75rem;
        padding: 0.125rem 0.5rem;
        background: #374151;
        border-radius: 4px;
    }
    
    /* Price Cell */
    .price {
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
    }
    
    /* Status Toggle */
    .status-toggle .status-badge {
        border: none;
        background: none;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .status-active { 
        background: rgba(34, 197, 94, 0.1); 
        color: #22c55e; 
    }
    
    .status-active:hover { 
        background: rgba(34, 197, 94, 0.2); 
    }
    
    .status-inactive { 
        background: rgba(107, 114, 128, 0.1); 
        color: #6b7280; 
    }
    
    .status-inactive:hover { 
        background: rgba(107, 114, 128, 0.2); 
    }
    
    /* Stock Badges */
    .stock-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-align: center;
        min-width: 45px;
    }
    
    .stock-good { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
    .stock-low { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .stock-out { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
    
    /* Date Cell */
    .date {
        color: #9ca3af;
        font-size: 0.875rem;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        text-decoration: none;
        font-size: 0.8rem;
        border: none;
        cursor: pointer;
    }
    
    .view-btn {
        background: rgba(107, 114, 128, 0.1);
        color: #9ca3af;
    }
    
    .view-btn:hover {
        background: rgba(107, 114, 128, 0.2);
        color: #d1d5db;
    }
    
    .edit-btn {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    
    .edit-btn:hover {
        background: rgba(59, 130, 246, 0.2);
        color: #60a5fa;
    }
    
    .delete-btn {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    
    .delete-btn:hover {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }
    
    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: rgba(107, 114, 128, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #6b7280;
    }
    
    .empty-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }
    
    .empty-description {
        color: #9ca3af;
        margin-bottom: 2rem;
    }
    
    .text-pink {
        color: #ec4899;
        text-decoration: none;
    }
    
    .text-pink:hover {
        color: #be185d;
    }
    
    /* Pagination */
    .pagination-section {
        padding: 1.5rem 2rem;
        border-top: 1px solid #374151;
        background: #111827;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }
        
        .filters-grid {
            grid-template-columns: 1fr;
        }
        
        .table-header,
        .table-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .cell {
            padding: 0.5rem 0;
            border-bottom: 1px solid #374151;
        }
        
        .cell:last-child {
            border-bottom: none;
        }
        
        .product-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
</style>
@endpush
