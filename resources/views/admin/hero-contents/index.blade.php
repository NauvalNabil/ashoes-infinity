@extends('admin.layouts.app')

@section('title', 'Hero Content Management')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white mb-2">Hero Content Management</h1>
            <p class="text-gray-400">Manage banner content displayed on the dashboard</p>
        </div>
        <div class="mt-4 lg:mt-0">
            <a href="{{ route('admin.hero-contents.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-plus"></i>
                Add New Hero Content
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-900/20 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center justify-between" role="alert">
            <span>{{ session('success') }}</span>
            <button type="button" class="text-green-400 hover:text-green-300" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Hero Contents Table -->
    <div class="bg-slate-800 rounded-lg border border-slate-700">
        <div class="p-4 border-b border-slate-700">
            <h3 class="text-lg font-semibold text-white">All Hero Contents</h3>
        </div>
        <div class="p-4">
            @if($heroContents->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-700">
                            <th class="text-left py-3 text-gray-400 font-medium">Order</th>
                            <th class="text-left py-3 text-gray-400 font-medium">Title</th>
                            <th class="text-left py-3 text-gray-400 font-medium">Subtitle</th>
                            <th class="text-left py-3 text-gray-400 font-medium">Button Text</th>
                            <th class="text-left py-3 text-gray-400 font-medium">Status</th>
                            <th class="text-left py-3 text-gray-400 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($heroContents as $hero)
                        <tr class="border-b border-slate-700/50">
                            <td class="py-3 text-white">{{ $hero->sort_order }}</td>
                            <td class="py-3">
                                <div class="text-white font-medium">{{ $hero->title }}</div>
                                @if($hero->background_image)
                                    <div class="text-xs text-gray-400 mt-1">Has background image</div>
                                @endif
                            </td>
                            <td class="py-3 text-gray-300">{{ $hero->subtitle ?? '-' }}</td>
                            <td class="py-3 text-gray-300">{{ $hero->button_text ?? '-' }}</td>
                            <td class="py-3">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox"
                                           class="sr-only status-toggle"
                                           {{ $hero->is_active ? 'checked' : '' }}
                                           data-hero-id="{{ $hero->id }}">
                                    <div class="relative">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 dark:peer-focus:ring-pink-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-pink-600"></div>
                                    </div>
                                    <span class="ml-3 text-sm text-gray-300">
                                        {{ $hero->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </label>
                            </td>
                            <td class="py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.hero-contents.show', $hero) }}" class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded transition-colors" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.hero-contents.edit', $hero) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white p-2 rounded transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="bg-red-600 hover:bg-red-700 text-white p-2 rounded transition-colors delete-btn"
                                            data-hero-id="{{ $hero->id }}"
                                            data-hero-title="{{ $hero->title }}"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12">
                <i class="fas fa-image text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-white mb-2">No Hero Content Found</h3>
                <p class="text-gray-400 mb-4">Create your first hero content to get started.</p>
                <a href="{{ route('admin.hero-contents.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg inline-flex items-center gap-2 transition-colors">
                    <i class="fas fa-plus"></i>
                    Add Your First Hero Content
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-slate-800 rounded-lg p-6 w-full max-w-md mx-4">
        <h3 class="text-lg font-semibold text-white mb-4">Confirm Delete</h3>
        <p class="text-gray-300 mb-2">Are you sure you want to delete hero content: <strong><span id="heroTitle" class="text-white"></span></strong>?</p>
        <p class="text-red-400 text-sm mb-6">This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded transition-colors" onclick="closeDeleteModal()">Cancel</button>
            <form id="deleteForm" method="POST" style="display: inline;">
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
    // Delete Modal Functions
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const heroTitleSpan = document.getElementById('heroTitle');

        // Delete button handlers
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const heroId = this.dataset.heroId;
                const heroTitle = this.dataset.heroTitle;

                deleteForm.action = `{{ route('admin.hero-contents.index') }}/${heroId}`;
                heroTitleSpan.textContent = heroTitle;

                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
        });

        // Status Toggle
        document.querySelectorAll('.status-toggle').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const heroId = this.dataset.heroId;
                const isActive = this.checked;

                fetch(`{{ route('admin.hero-contents.index') }}/${heroId}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        is_active: isActive
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const label = this.parentNode.parentNode.querySelector('span');
                        label.textContent = data.is_active ? 'Active' : 'Inactive';

                        // Show success message
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'bg-green-900/20 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center justify-between';
                        alertDiv.innerHTML = `
                            <span>${data.message}</span>
                            <button type="button" class="text-green-400 hover:text-green-300" onclick="this.parentElement.remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                        document.querySelector('.p-6').insertBefore(alertDiv, document.querySelector('.bg-slate-800'));

                        // Auto hide after 3 seconds
                        setTimeout(() => {
                            alertDiv.remove();
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.checked = !isActive; // Revert toggle on error
                });
            });
        });
    });
</script>
@endpush
