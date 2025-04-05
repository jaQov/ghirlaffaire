@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

    <h1 class="text-3xl font-bold mb-6">Catalog</h1>

    {{-- Filter Bar --}}
    <form method="GET" action="{{ route('catalog') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            {{-- Search Input --}}
            <div>
                <label for="search"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                <input type="text" name="search" id="search" value="{{ $filters['search'] ?? '' }}"
                    class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>

            {{-- Category Dropdown --}}
            <div>
                <label for="category"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <select name="category" id="category"
                    class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" {{ ($filters['category'] ?? '' )==$category->slug ? 'selected'
                        : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Price Range --}}
            <div>
                <label for="min_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Min
                    Price</label>
                <input type="number" name="min_price" id="min_price" value="{{ $filters['min_price'] ?? '' }}"
                    class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white">
            </div>

            <div>
                <label for="max_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Max
                    Price</label>
                <input type="number" name="max_price" id="max_price" value="{{ $filters['max_price'] ?? '' }}"
                    class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white">
            </div>
        </div>

        <div class="mt-4 flex justify-between items-center">
            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-semibold py-2 px-6 rounded">
                Apply Filters
            </button>

            @if(!empty(array_filter($filters)))
            <a href="{{ route('catalog') }}" class="text-sm text-red-600 hover:underline">
                Reset Filters
            </a>
            @endif
        </div>
    </form>

    {{-- Products Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @forelse ($products as $product)
        <x-product-card :product="$product" />
        @empty
        <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
            No products found.
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection