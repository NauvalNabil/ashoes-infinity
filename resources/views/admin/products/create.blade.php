@extends('admin.layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="product-form-container">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Add New Product</h1>
            <p class="page-subtitle">Create a new product for your store inventory</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i>
                Back to Products
            </a>
        </div>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf
        <div class="form-grid">
            <!-- Basic Information -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        Basic Information
                    </h2>
                </div>
                <div class="section-content">
                    <div class="form-grid-2">
                        <div class="form-group full-width">
                            <label for="name" class="form-label">Product Name *</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   placeholder="Enter product name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" 
                                   class="form-control @error('brand') is-invalid @enderror" 
                                   id="brand" 
                                   name="brand" 
                                   value="{{ old('brand') }}"
                                   placeholder="Enter brand name">
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category">
                                <option value="">Select Category</option>
                                <option value="men" {{ old('category') == 'men' ? 'selected' : '' }}>Men's Shoes</option>
                                <option value="women" {{ old('category') == 'women' ? 'selected' : '' }}>Women's Shoes</option>
                                <option value="sports" {{ old('category') == 'sports' ? 'selected' : '' }}>Sports Shoes</option>
                                <option value="casual" {{ old('category') == 'casual' ? 'selected' : '' }}>Casual Shoes</option>
                                <option value="formal" {{ old('category') == 'formal' ? 'selected' : '' }}>Formal Shoes</option>
                                <option value="boots" {{ old('category') == 'boots' ? 'selected' : '' }}>Boots</option>
                                <option value="sandals" {{ old('category') == 'sandals' ? 'selected' : '' }}>Sandals</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Detailed product description...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pricing & Inventory -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-dollar-sign"></i>
                        Pricing & Inventory
                    </h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price ($) *</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" 
                                   step="0.01" min="0" required>
                        </div>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock Quantity *</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" name="stock" value="{{ old('stock', 0) }}" 
                               min="0" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control @error('color') is-invalid @enderror" 
                               id="color" name="color" value="{{ old('color') }}" 
                               placeholder="e.g., Black, White, Red">
                        @error('color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Available Sizes</label>
                        <div class="row g-2">
                            @foreach(['6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12'] as $size)
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="sizes[]" value="{{ $size }}" 
                                           id="size{{ $size }}"
                                           {{ in_array($size, old('sizes', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="size{{ $size }}">
                                        {{ $size }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('sizes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" 
                               id="is_active" name="is_active" value="1" 
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active Product
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Images -->
        <div class="col-12 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-image me-2"></i>Product Images
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Main Product Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">Recommended: 800x800px, max 2MB</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <img id="previewImg" class="rounded border border-pink" 
                                     style="max-width: 200px; max-height: 200px; object-fit: cover;">
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="gallery" class="form-label">Gallery Images</label>
                            <input type="file" class="form-control @error('gallery.*') is-invalid @enderror" 
                                   id="gallery" name="gallery[]" accept="image/*" multiple>
                            <small class="form-text text-muted">Multiple images allowed, max 2MB each</small>
                            @error('gallery.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Gallery Preview -->
                            <div id="galleryPreview" class="mt-3 row g-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Submit Buttons -->
        <div class="col-12">
            <div class="admin-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" 
                                onclick="window.location.href='{{ route('admin.products.index') }}'">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        
                        <div>
                            <button type="submit" name="action" value="save" class="btn btn-outline-pink me-2">
                                <i class="fas fa-save me-2"></i>Save as Draft
                            </button>
                            <button type="submit" name="action" value="publish" class="btn btn-pink">
                                <i class="fas fa-rocket me-2"></i>Publish Product
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Main image preview
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        });
        
        // Gallery images preview
        const galleryInput = document.getElementById('gallery');
        const galleryPreview = document.getElementById('galleryPreview');
        
        galleryInput.addEventListener('change', function(e) {
            galleryPreview.innerHTML = '';
            const files = Array.from(e.target.files);
            
            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-6 col-md-3';
                        col.innerHTML = `
                            <img src="${e.target.result}" 
                                 class="img-fluid rounded border border-pink" 
                                 style="aspect-ratio: 1; object-fit: cover;">
                        `;
                        galleryPreview.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
        
        // Form submission handling
        const form = document.getElementById('productForm');
        form.addEventListener('submit', function(e) {
            const action = e.submitter.value;
            const isActiveInput = document.getElementById('is_active');
            
            if (action === 'save') {
                // Save as draft - set inactive
                isActiveInput.checked = false;
            } else if (action === 'publish') {
                // Publish - set active
                isActiveInput.checked = true;
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Product Form Styles */
    .product-form-container {
        max-width: 1200px;
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
    
    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    
    .form-section {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .section-header {
        background: #111827;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #374151;
    }
    
    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #ffffff;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .section-content {
        padding: 2rem;
    }
    
    /* Form Elements */
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
    }
    
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    
    .form-label {
        color: #ffffff !important;
        font-weight: 500;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }
    
    .form-control, 
    .form-select {
        background: #111827 !important;
        border: 1px solid #374151 !important;
        color: #ffffff !important;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    
    .form-control:focus, 
    .form-select:focus {
        border-color: #ec4899 !important;
        box-shadow: 0 0 0 0.2rem rgba(236, 72, 153, 0.25);
        background: #111827 !important;
        color: #ffffff !important;
    }
    
    .form-control::placeholder {
        color: #6b7280;
    }
    
    .form-text {
        color: #9ca3af;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }
    
    /* Invalid Feedback */
    .is-invalid {
        border-color: #ef4444 !important;
    }
    
    .invalid-feedback {
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }
    
    /* File Upload Area */
    .upload-area {
        border: 2px dashed #374151;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .upload-area:hover {
        border-color: #ec4899;
        background: rgba(236, 72, 153, 0.05);
    }
    
    .upload-area.dragover {
        border-color: #ec4899;
        background: rgba(236, 72, 153, 0.1);
    }
    
    .upload-icon {
        font-size: 2rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }
    
    .upload-text {
        color: #ffffff;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .upload-hint {
        color: #9ca3af;
        font-size: 0.8rem;
    }
    
    /* Preview Areas */
    .image-preview {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        background: #111827;
        border: 1px solid #374151;
    }
    
    .preview-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .remove-image {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        background: rgba(239, 68, 68, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .remove-image:hover {
        background: #ef4444;
        transform: scale(1.1);
    }
    
    /* Size Tags */
    .sizes-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .size-tag {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #374151;
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8rem;
        color: #ffffff;
    }
    
    .size-tag .remove-size {
        background: none;
        border: none;
        color: #ef4444;
        cursor: pointer;
        padding: 0;
        font-size: 0.8rem;
    }
    
    /* Form Actions */
    .form-actions {
        grid-column: 1 / -1;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding: 2rem;
        background: #111827;
        border-top: 1px solid #374151;
        margin-top: 2rem;
        border-radius: 12px;
    }
    
    /* Buttons */
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
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
    
    .btn-outline-secondary {
        background: transparent;
        color: #9ca3af;
        border: 1px solid #374151;
    }
    
    .btn-outline-secondary:hover {
        background: #374151;
        color: white;
        border-color: #4b5563;
    }
    
    .btn-success {
        background: #22c55e;
        color: white;
        border: none;
    }
    
    .btn-success:hover {
        background: #16a34a;
        color: white;
    }
    
    /* Responsive */
    @media (max-width: 968px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .page-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }
        
        .form-grid-2 {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
    }
</style>
@endpush
