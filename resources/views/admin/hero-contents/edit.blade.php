@extends('admin.layouts.app')

@section('title', 'Edit Hero Content')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white mb-2">Edit Hero Content</h1>
            <p class="text-gray-400">Update banner content for your dashboard</p>
        </div>
        <div class="mt-4 lg:mt-0 flex gap-2">
            <a href="{{ route('admin.hero-contents.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-arrow-left"></i>
                Back to Hero Contents
            </a>
            <a href="{{ route('admin.hero-contents.show', $heroContent) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-eye"></i>
                View
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-900/20 border border-red-500 text-red-400 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <div class="bg-slate-800 rounded-lg border border-slate-700">
        <div class="p-6">
            <form action="{{ route('admin.hero-contents.update', $heroContent) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                                Title <span class="text-red-400">*</span>
                            </label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $heroContent->title) }}"
                                   class="w-full bg-slate-700 border border-slate-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors"
                                   placeholder="Enter hero title"
                                   required>
                        </div>

                        <!-- Subtitle -->
                        <div>
                            <label for="subtitle" class="block text-sm font-medium text-gray-300 mb-2">
                                Subtitle
                            </label>
                            <input type="text"
                                   id="subtitle"
                                   name="subtitle"
                                   value="{{ old('subtitle', $heroContent->subtitle) }}"
                                   class="w-full bg-slate-700 border border-slate-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors"
                                   placeholder="Enter subtitle">
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                                Description
                            </label>
                            <textarea id="description"
                                      name="description"
                                      rows="4"
                                      class="w-full bg-slate-700 border border-slate-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors"
                                      placeholder="Enter description">{{ old('description', $heroContent->description) }}</textarea>
                        </div>

                        <!-- Button Text -->
                        <div>
                            <label for="button_text" class="block text-sm font-medium text-gray-300 mb-2">
                                Button Text
                            </label>
                            <input type="text"
                                   id="button_text"
                                   name="button_text"
                                   value="{{ old('button_text', $heroContent->button_text) }}"
                                   class="w-full bg-slate-700 border border-slate-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors"
                                   placeholder="e.g., Shop Now, Learn More">
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Button URL -->
                        <div>
                            <label for="button_url" class="block text-sm font-medium text-gray-300 mb-2">
                                Button URL
                            </label>
                            <input type="url"
                                   id="button_url"
                                   name="button_url"
                                   value="{{ old('button_url', $heroContent->button_url) }}"
                                   class="w-full bg-slate-700 border border-slate-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors"
                                   placeholder="https://example.com or #products">
                        </div>

                        <!-- Current Background Image -->
                        @if($heroContent->background_image)
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">
                                Current Background Image
                            </label>
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $heroContent->background_image) }}"
                                     alt="Current background"
                                     class="max-h-32 rounded-lg border border-slate-600">
                            </div>
                        </div>
                        @endif

                        <!-- Background Image -->
                        <div>
                            <label for="background_image" class="block text-sm font-medium text-gray-300 mb-2">
                                {{ $heroContent->background_image ? 'Replace Background Image' : 'Background Image' }}
                            </label>
                            <div class="border-2 border-dashed border-slate-600 rounded-lg p-6 text-center hover:border-pink-500 transition-colors">
                                <input type="file"
                                       id="background_image"
                                       name="background_image"
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewImage(this)">
                                <label for="background_image" class="cursor-pointer">
                                    <div id="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-300 mb-1">{{ $heroContent->background_image ? 'Click to replace image' : 'Click to upload image' }}</p>
                                        <p class="text-sm text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                    <div id="image-preview" class="hidden">
                                        <img id="preview-img" src="" alt="Preview" class="max-h-40 mx-auto rounded-lg">
                                        <p class="text-sm text-gray-400 mt-2">Click to change image</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-300 mb-2">
                                Sort Order
                            </label>
                            <input type="number"
                                   id="sort_order"
                                   name="sort_order"
                                   value="{{ old('sort_order', $heroContent->sort_order) }}"
                                   min="0"
                                   class="w-full bg-slate-700 border border-slate-600 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors"
                                   placeholder="0">
                            <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="flex items-center cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', $heroContent->is_active) ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 dark:peer-focus:ring-pink-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-pink-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-300">Active</span>
                            </label>
                            <p class="text-sm text-gray-500 mt-1">Hero content will be visible on dashboard when active</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-slate-700">
                    <a href="{{ route('admin.hero-contents.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Update Hero Content
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const file = input.files[0];
        const placeholder = document.getElementById('upload-placeholder');
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                placeholder.classList.add('hidden');
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
