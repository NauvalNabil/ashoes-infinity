@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin Panel')

@section('content')
<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header mb-4">
        <div>
            <h1 class="dashboard-title">Dashboard</h1>
            <p class="dashboard-subtitle">Monitor your store's performance and manage products efficiently</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add Product
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid mb-5">
        <div class="stat-item">
            <div class="stat-content">
                <div class="stat-value">{{ $totalProducts }}</div>
                <div class="stat-label">Total Products</div>
            </div>
            <div class="stat-icon stat-icon-primary">
                <i class="fas fa-cube"></i>
            </div>
        </div>
        
        <div class="stat-item">
            <div class="stat-content">
                <div class="stat-value">{{ $activeProducts }}</div>
                <div class="stat-label">Active Products</div>
            </div>
            <div class="stat-icon stat-icon-success">
                <i class="fas fa-check"></i>
            </div>
        </div>
        
        <div class="stat-item">
            <div class="stat-content">
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-icon stat-icon-info">
                <i class="fas fa-users"></i>
            </div>
        </div>
        
        <div class="stat-item">
            <div class="stat-content">
                <div class="stat-value">{{ $lowStockProducts }}</div>
                <div class="stat-label">Low Stock</div>
            </div>
            <div class="stat-icon stat-icon-warning">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
    </div>

    <!-- Recent Products -->
    <div class="products-section">
        <div class="section-header">
            <h2 class="section-title">Recent Products</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline">View All Products</a>
        </div>
        
        @if($recentProducts->count() > 0)
            <div class="products-table">
                <div class="table-header">
                    <div class="header-cell">Product</div>
                    <div class="header-cell">Price</div>
                    <div class="header-cell">Stock</div>
                    <div class="header-cell">Status</div>
                    <div class="header-cell">Actions</div>
                </div>
                
                @foreach($recentProducts as $product)
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
                                @if($product->brand)
                                    <div class="product-brand">{{ $product->brand }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="cell price-cell">
                        <span class="price">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <div class="cell stock-cell">
                        <span class="stock-badge {{ $product->stock <= 10 ? 'stock-low' : 'stock-good' }}">
                            {{ $product->stock }}
                        </span>
                    </div>
                    <div class="cell status-cell">
                        <span class="status-badge {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="cell actions-cell">
                        <div class="action-buttons">
                            <a href="{{ route('admin.products.edit', $product) }}" 
                               class="action-btn edit-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.products.show', $product) }}" 
                               class="action-btn view-btn" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <h3 class="empty-title">No products yet</h3>
                <p class="empty-description">Start by adding your first product to get started</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Add Your First Product
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Dashboard Layout */
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    /* Header */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
    }
    
    .dashboard-title {
        font-size: 2rem;
        font-weight: 600;
        color: #ffffff;
        margin: 0;
        line-height: 1.2;
    }
    
    .dashboard-subtitle {
        color: #9ca3af;
        margin: 0.5rem 0 0 0;
        font-size: 0.95rem;
    }
    
    .header-actions {
        display: flex;
        gap: 1rem;
    }
    
    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        font-size: 0.9rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
        color: white;
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
        color: white;
    }
    
    .btn-outline {
        background: transparent;
        color: #9ca3af;
        border: 1px solid #374151;
    }
    
    .btn-outline:hover {
        background: #374151;
        color: white;
        border-color: #4b5563;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }
    
    .stat-item {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.2s ease;
    }
    
    .stat-item:hover {
        border-color: #4b5563;
        transform: translateY(-2px);
    }
    
    .stat-content {
        flex: 1;
    }
    
    .stat-value {
        font-size: 2.25rem;
        font-weight: 700;
        color: #ffffff;
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: #9ca3af;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .stat-icon-primary { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .stat-icon-success { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
    .stat-icon-info { background: rgba(168, 85, 247, 0.1); color: #a855f7; }
    .stat-icon-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    
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
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #ffffff;
        margin: 0;
    }
    
    /* Custom Table */
    .products-table {
        width: 100%;
    }
    
    .table-header {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
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
        grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
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
        width: 40px;
        height: 40px;
        border-radius: 6px;
        object-fit: cover;
    }
    
    .product-placeholder {
        width: 40px;
        height: 40px;
        background: #374151;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
    }
    
    .product-name {
        color: #ffffff;
        font-weight: 500;
        margin-bottom: 0.25rem;
    }
    
    .product-brand {
        color: #9ca3af;
        font-size: 0.8rem;
    }
    
    /* Price Cell */
    .price {
        color: #ffffff;
        font-weight: 600;
    }
    
    /* Badges */
    .stock-badge, .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-align: center;
    }
    
    .stock-good { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
    .stock-low { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
    
    .status-active { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
    .status-inactive { background: rgba(107, 114, 128, 0.1); color: #6b7280; }
    
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
    }
    
    .edit-btn {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    
    .edit-btn:hover {
        background: rgba(59, 130, 246, 0.2);
        color: #60a5fa;
    }
    
    .view-btn {
        background: rgba(107, 114, 128, 0.1);
        color: #9ca3af;
        border: 1px solid rgba(107, 114, 128, 0.2);
    }
    
    .view-btn:hover {
        background: rgba(107, 114, 128, 0.2);
        color: #d1d5db;
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
    
    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }
        
        .stats-grid {
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
        
        .header-cell::before {
            content: attr(data-label) ": ";
            font-weight: 600;
            color: #ffffff;
        }
    }
</style>
@endpush
