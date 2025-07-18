@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1 class="h2 mb-0" style="color: var(--primary-pink); font-weight: 700;">Edit Product</h1>
        <p class="text-muted">Update product information</p>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-pink">
            <i class="fas fa-arrow-left me-2"></i>Back to Products
        </a>
    </div>
</div>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="productForm">
    @csrf
    @method('PUT')
    <div class="row">
        <!-- Basic Information -->
        <div class="col-lg-8 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Basic Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Product Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" 
                                   id="brand" name="brand" value="{{ old('brand', $product->brand) }}">
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category">
                                <option value="">Select Category</option>
                                <option value="men" {{ old('category', $product->category) == 'men' ? 'selected' : '' }}>Men's Shoes</option>
                                <option value="women" {{ old('category', $product->category) == 'women' ? 'selected' : '' }}>Women's Shoes</option>
                                <option value="sports" {{ old('category', $product->category) == 'sports' ? 'selected' : '' }}>Sports Shoes</option>
                                <option value="casual" {{ old('category', $product->category) == 'casual' ? 'selected' : '' }}>Casual Shoes</option>
                                <option value="formal" {{ old('category', $product->category) == 'formal' ? 'selected' : '' }}>Formal Shoes</option>
                                <option value="boots" {{ old('category', $product->category) == 'boots' ? 'selected' : '' }}>Boots</option>
                                <option value="sandals" {{ old('category', $product->category) == 'sandals' ? 'selected' : '' }}>Sandals</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" 
                                      placeholder="Detailed product description...">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pricing & Inventory -->
        <div class="col-lg-4 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-dollar-sign me-2"></i>Pricing & Inventory
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price ($) *</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', $product->price) }}" 
                                   step="0.01" min="0" required>
                        </div>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock Quantity *</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" name="stock" value="{{ old('stock', $product->stock) }}" 
                               min="0" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control @error('color') is-invalid @enderror" 
                               id="color" name="color" value="{{ old('color', $product->color) }}" 
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
                                           {{ in_array($size, old('sizes', $product->sizes ?? [])) ? 'checked' : '' }}>
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
                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active Product
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Current Images -->
        @if($product->image || $product->gallery)
        <div class="col-12 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-images me-2"></i>Current Images
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($product->image)
                        <div class="col-md-6 mb-3">
                            <h6>Main Image</h6>
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="Main Image" 
                                     class="img-fluid rounded border border-pink"
                                     style="max-width: 200px; max-height: 200px; object-fit: cover;">
                            </div>
                        </div>
                        @endif
                        
                        @if($product->gallery && count($product->gallery) > 0)
                        <div class="col-md-6">
                            <h6>Gallery Images</h6>
                            <div class="row g-2">
                                @foreach($product->gallery as $image)
                                <div class="col-6">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                         alt="Gallery Image" 
                                         class="img-fluid rounded border border-pink"
                                         style="aspect-ratio: 1; object-fit: cover;">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Update Images -->
        <div class="col-12 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-image me-2"></i>Update Product Images
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Uploading new images will replace the existing ones.
                    </div>
                    
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
                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-outline-info me-2">
                                <i class="fas fa-eye me-2"></i>View Product
                            </a>
                            <button type="submit" class="btn btn-pink">
                                <i class="fas fa-save me-2"></i>Update Product
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
    });
</script>
@endpush
