{{-- resources/views/product/details.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4">
    <div class="max-w-4xl mx-auto bg-gray-100 shadow-lg rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Images -->
            <div>
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->title }}"
                    class="w-full rounded-lg shadow">
            </div>

            <!-- Product Info -->
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $product->title }}</h1>
                <div class="mt-3">
                    <span class="text-2xl font-bold text-green-600">{{ $product->price }} DZD</span>
                    @if($product->compare_at_price)
                    <span class="text-lg text-gray-500 line-through">{{ $product->compare_at_price }} DZD</span>
                    <span class="ml-2 px-2 py-1 text-sm font-medium bg-red-500 text-white rounded">{{
                        $product->calculateDiscount() }}% OFF</span>
                    @endif
                </div>

                <!-- Order Form Component -->
                <x-form.order-form :product="$product" :wilayas="$wilayas" />
            </div>
        </div>

        <!-- Product Description -->
        <div class="mt-6 p-4 bg-gray-200 rounded">
            <h2 class="text-xl font-semibold text-gray-700">Product Description</h2>
            <p class="mt-2 text-gray-600">{{ $product->description }}</p>
        </div>
    </div>
</div>
@endsection