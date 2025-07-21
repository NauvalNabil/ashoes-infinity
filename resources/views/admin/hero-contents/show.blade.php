@extends('admin.layouts.app')

@section('title', 'View Hero Content')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white mb-2">Hero Content Details</h1>
            <p class="text-gray-400">View hero content information</p>
        </div>
        <div class="mt-4 lg:mt-0 flex gap-2">
            <a href="{{ route('admin.hero-contents.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-arrow-left"></i>
                Back to Hero Contents
            </a>
            <a href="{{ route('admin.hero-contents.edit', $heroContent) }}" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-edit"></i>
                Edit
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Content Information -->
        <div class="bg-slate-800 rounded-lg border border-slate-700">
            <div class="p-4 border-b border-slate-700">
                <h3 class="text-lg font-semibold text-white">Content Information</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Title</label>
                    <p class="text-white text-lg font-medium">{{ $heroContent->title }}</p>
                </div>

                @if($heroContent->subtitle)
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Subtitle</label>
                    <p class="text-gray-300">{{ $heroContent->subtitle }}</p>
                </div>
                @endif

                @if($heroContent->description)
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Description</label>
                    <p class="text-gray-300 leading-relaxed">{{ $heroContent->description }}</p>
                </div>
                @endif

                @if($heroContent->button_text)
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Button Text</label>
                    <p class="text-gray-300">{{ $heroContent->button_text }}</p>
                </div>
                @endif

                @if($heroContent->button_url)
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Button URL</label>
                    <a href="{{ $heroContent->button_url }}" target="_blank" class="text-pink-400 hover:text-pink-300 underline">
                        {{ $heroContent->button_url }}
                    </a>
                </div>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Sort Order</label>
                        <p class="text-gray-300">{{ $heroContent->sort_order }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Status</label>
                        @if($heroContent->is_active)
                            <span class="bg-green-900/20 text-green-400 px-2 py-1 rounded-full text-sm">Active</span>
                        @else
                            <span class="bg-red-900/20 text-red-400 px-2 py-1 rounded-full text-sm">Inactive</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Created</label>
                        <p class="text-gray-300 text-sm">{{ $heroContent->created_at->format('M d, Y \a\t H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Last Updated</label>
                        <p class="text-gray-300 text-sm">{{ $heroContent->updated_at->format('M d, Y \a\t H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="bg-slate-800 rounded-lg border border-slate-700">
            <div class="p-4 border-b border-slate-700">
                <h3 class="text-lg font-semibold text-white">Preview</h3>
            </div>
            <div class="p-6">
                <!-- Hero Preview -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg relative"
                     @if($heroContent->background_image)
                     style="background-image: url('{{ asset('storage/' . $heroContent->background_image) }}'); background-size: cover; background-position: center; min-height: 300px;"
                     @endif>
                    <div class="@if($heroContent->background_image) bg-black bg-opacity-50 @endif p-8 text-center">
                        <h1 class="text-3xl font-bold mb-4 @if($heroContent->background_image) text-white @else text-gray-900 dark:text-gray-100 @endif">
                            {{ $heroContent->title }}
                        </h1>
                        @if($heroContent->subtitle)
                        <h2 class="text-lg mb-4 @if($heroContent->background_image) text-gray-200 @else text-gray-600 dark:text-gray-400 @endif">
                            {{ $heroContent->subtitle }}
                        </h2>
                        @endif
                        @if($heroContent->description)
                        <p class="text-base mb-6 max-w-2xl mx-auto @if($heroContent->background_image) text-gray-300 @else text-gray-700 dark:text-gray-300 @endif">
                            {{ $heroContent->description }}
                        </p>
                        @endif
                        @if($heroContent->button_text && $heroContent->button_url)
                        <a href="{{ $heroContent->button_url }}" class="inline-block bg-gradient-to-r from-pink-500 to-orange-400 text-white px-6 py-2 rounded-full text-base font-medium hover:from-pink-600 hover:to-orange-500 transition-colors">
                            {{ $heroContent->button_text }}
                        </a>
                        @endif
                    </div>
                </div>

                @if($heroContent->background_image)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Background Image Details</label>
                    <div class="bg-slate-700 rounded-lg p-4">
                        <img src="{{ asset('storage/' . $heroContent->background_image) }}"
                             alt="Background Image"
                             class="w-full h-32 object-cover rounded-lg mb-3">
                        <p class="text-sm text-gray-400">
                            <i class="fas fa-image mr-1"></i>
                            {{ basename($heroContent->background_image) }}
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-6 flex justify-end gap-3">
        <a href="{{ route('admin.hero-contents.edit', $heroContent) }}" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2">
            <i class="fas fa-edit"></i>
            Edit Hero Content
        </a>
        <button type="button"
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2"
                onclick="confirmDelete()">
            <i class="fas fa-trash"></i>
            Delete
        </button>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-slate-800 rounded-lg p-6 w-full max-w-md mx-4">
        <h3 class="text-lg font-semibold text-white mb-4">Confirm Delete</h3>
        <p class="text-gray-300 mb-2">Are you sure you want to delete this hero content?</p>
        <p class="text-red-400 text-sm mb-6">This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded transition-colors" onclick="closeDeleteModal()">Cancel</button>
            <form action="{{ route('admin.hero-contents.destroy', $heroContent) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition-colors">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete() {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
</script>
@endpush
