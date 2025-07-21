@extends('admin.layouts.app')

@section('title', 'Orders Management - AShoes Infinity')

@section('content')
<div class="orders-management">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Orders Management</h1>
            <p class="page-subtitle">Monitor and manage customer orders</p>
        </div>
        <div class="header-actions">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-download"></i> Export
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-csv"></i> Export CSV</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf"></i> Export PDF</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="filters-form">
            <div class="filters-grid">
                <div class="filter-group">
                    <input type="text" 
                           class="form-control" 
                           name="search" 
                           placeholder="Search orders..." 
                           value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <select class="form-select" name="status">
                        <option value="">All Status</option>
                        @foreach($statusOptions as $value => $label)
                            <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-select" name="payment_status">
                        <option value="">All Payment Status</option>
                        @foreach($paymentStatusOptions as $value => $label)
                            <option value="{{ $value }}" {{ request('payment_status') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <input type="date" 
                           class="form-control" 
                           name="date_from" 
                           value="{{ request('date_from') }}"
                           placeholder="From Date">
                </div>
                <div class="filter-group">
                    <input type="date" 
                           class="form-control" 
                           name="date_to" 
                           value="{{ request('date_to') }}"
                           placeholder="To Date">
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="orders-section">
        <div class="section-header">
            <h2 class="section-title">Orders List</h2>
            <div class="section-meta">
                <span class="results-count">{{ $orders->total() }} orders found</span>
            </div>
        </div>

        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <strong>{{ $order->order_number }}</strong>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $order->user->name }}</strong><br>
                                        <small class="text-muted">{{ $order->user->email }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $order->orderItems->count() }} items</span>
                                </td>
                                <td>
                                    <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm status-selector" 
                                            data-order-id="{{ $order->id }}"
                                            style="min-width: 120px;">
                                        @foreach($statusOptions as $value => $label)
                                            <option value="{{ $value }}" {{ $order->status == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <span class="badge 
                                        @switch($order->payment_status)
                                            @case('pending') bg-warning @break
                                            @case('paid') bg-success @break
                                            @case('failed') bg-danger @break
                                            @default bg-secondary
                                        @endswitch
                                    ">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                    @if($order->payment_proof)
                                        <br><small class="text-muted">
                                            <i class="fas fa-paperclip"></i> Proof uploaded
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        {{ $order->created_at->format('M d, Y') }}<br>
                                        <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.orders.show', $order) }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#quickEditModal"
                                                onclick="openQuickEdit({{ $order->id }}, '{{ $order->status }}', '{{ $order->payment_status }}')"
                                                title="Quick Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-section">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x mb-3" style="color: var(--primary-pink); opacity: 0.5;"></i>
                <h5>No orders found</h5>
                <p class="text-muted">
                    @if(request()->hasAny(['search', 'status', 'payment_status', 'date_from', 'date_to']))
                        Try adjusting your filters or <a href="{{ route('admin.orders.index') }}" class="text-pink">clear all filters</a>
                    @else
                        No orders have been placed yet
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>

<!-- Quick Edit Modal -->
<div class="modal fade" id="quickEditModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quick Edit Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="quickEditForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Order Status</label>
                        <select class="form-select" name="status" id="modalStatus" required>
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Payment Status</label>
                        <select class="form-select" name="payment_status" id="modalPaymentStatus" required>
                            @foreach($paymentStatusOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" name="notes" rows="3" placeholder="Add notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Quick status update
$('.status-selector').on('change', function() {
    const orderId = $(this).data('order-id');
    const newStatus = $(this).val();
    
    if (confirm('Are you sure you want to update this order status?')) {
        $.ajax({
            url: `/admin/orders/${orderId}/status`,
            method: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert('Error updating status. Please try again.');
                location.reload();
            }
        });
    } else {
        // Reset to original value
        location.reload();
    }
});

// Quick edit modal
function openQuickEdit(orderId, currentStatus, currentPaymentStatus) {
    $('#quickEditForm').attr('action', `/admin/orders/${orderId}`);
    $('#modalStatus').val(currentStatus);
    $('#modalPaymentStatus').val(currentPaymentStatus);
}

// Quick edit form submission
$('#quickEditForm').on('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
        url: $(this).attr('action'),
        method: 'PUT',
        data: $(this).serialize(),
        success: function(response) {
            $('#quickEditModal').modal('hide');
            location.reload();
        },
        error: function(xhr) {
            alert('Error updating order. Please try again.');
        }
    });
});
</script>
@endpush

@push('styles')
<style>
.filters-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr auto;
    gap: 1rem;
    align-items: end;
}

.status-selector {
    border: none;
    background: transparent;
    font-size: 0.875rem;
}

.status-selector:focus {
    box-shadow: 0 0 0 0.2rem rgba(236, 72, 153, 0.25);
    border-color: #8b4513;
}

@media (max-width: 768px) {
    .filters-grid {
        grid-template-columns: 1fr;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
}
</style>
@endpush
