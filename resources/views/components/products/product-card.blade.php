@props(['product'])

<div class="p-4 border rounded-lg shadow">
    <!-- Product Image -->
    <a href="#">
        <img class="w-full rounded-xl" src="{{ asset($product->image_url) }}" alt="{{ $product->title }}">
    </a>

    <!-- Product Details -->
    <div class="mt-3">
        <!-- Display All Categories -->
        <div class="flex items-center mb-2">
            @foreach ($product->categories as $category)
                <span class="bg-red-600 text-white rounded-xl px-3 py-1 text-sm mr-3">
                    {{ $category->name }} <!-- Make sure your Category model has a 'name' column -->
                </span>
            @endforeach
        </div>

        <!-- Product Title -->
        <a class="text-xl font-bold text-gray-900">{{ $product->title }}</a>
    </div>
</div>