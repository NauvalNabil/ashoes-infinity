@extends('admin.layouts.app')

@section('title', $category->name)

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
            <a href="{{ route('admin.categories.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $category->name }}</h1>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.categories.edit', $category) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Edit Category
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Category Details -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Category Details</h2>

            @if($category->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover rounded-lg">
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->name }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Slug</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-mono">{{ $category->slug }}</dd>
                </div>

                @if($category->description)
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->description }}</dd>
                </div>
                @endif

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                    <dd class="mt-1">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $category->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Sort Order</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->sort_order }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Products</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->products->count() }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->created_at->format('M d, Y at h:i A') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->updated_at->format('M d, Y at h:i A') }}</dd>
                </div>
            </div>
        </div>
    </div>

    <!-- Products in Category -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Products in this Category</h2>
            </div>

            @if($category->products->count() > 0)
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($category->products as $product)
                    <div class="p-6 flex items-center justify-between">
                        <div class="flex items-center">
                            @if($product->image)
                                <img class="h-16 w-16 rounded-lg object-cover mr-4" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <div class="h-16 w-16 rounded-lg bg-gray-200 dark:bg-gray-600 mr-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $product->name }}</h3>
                                @if($product->brand)
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $product->brand }}</p>
                                @endif
                                <div class="flex items-center mt-1">
                                    <span class="text-lg font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                                    <span class="ml-4 text-sm {{ $product->stock > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                        {{ $product->stock > 0 ? "Stock: {$product->stock}" : 'Out of Stock' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.products.show', $product) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                View
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">
                                Edit
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($category->products->count() === 10)
                <div class="p-6 border-t border-gray-200 dark:border-gray-700 text-center">
                    <a href="{{ route('admin.products.index', ['category' => $category->slug]) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                        View all products in this category →
                    </a>
                </div>
                @endif
            @else
                <div class="p-6 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Products</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4">This category doesn't have any products yet.</p>
                    <a href="{{ route('admin.products.create', ['category' => $category->id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        Add First Product
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
