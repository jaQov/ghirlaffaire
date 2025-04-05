@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <!-- Product Hero Section -->
    <div class="flex flex-col md:flex-row items-center md:items-start">
        <!-- Product Image -->
        <div class="w-full md:w-1/2">
            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->title }}"
                class="w-full h-auto object-cover rounded-lg shadow-lg">
        </div>
        <!-- Product Information -->
        <div class="mt-6 md:mt-0 md:ml-12 w-full md:w-1/2">
            <h1 class="text-4xl font-bold text-gray-800">{{ $product->title }}</h1>


            <!-- Price & Discount -->
            <div class="mt-6 flex items-center space-x-4">
                <span class="text-3xl font-bold text-green-600">
                    {{ number_format($product->price, 2) }} DZD
                </span>
                @if($product->compare_at_price)
                <span class="text-xl text-gray-500 line-through">
                    {{ number_format($product->compare_at_price, 2) }} DZD
                </span>
                <span class="px-3 py-1 bg-red-500 text-white text-xs font-semibold rounded-full">
                    -{{ $product->calculateDiscount() }}%
                </span>
                @endif
            </div>

            <!-- Ratings (Example) -->
            <div class="mt-4 flex items-center">
                @for($i = 0; $i < 5; $i++) <svg class="h-6 w-6 {{ $i < 4 ? 'text-yellow-400' : 'text-gray-300' }}"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                    </svg>
                    @endfor
                    <span class="ml-3 text-sm text-gray-600">(4.5/5)</span>
            </div>

            @livewire('order-form', ['product' => $product])


            {{--
            <!-- Buy Button -->
            <div class="mt-8">
                <a href="{{ route('cart.add', $product->id) }}"
                    class="inline-block px-8 py-3 bg-blue-600 text-white text-lg font-medium rounded-lg shadow hover:bg-blue-700 transition duration-300">
                    Add to Cart
                </a>
            </div> --}}
        </div>
    </div>

    <!-- Additional Product Details / Reviews (optional) -->
    <div class="mt-12">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Product Details</h2>
        <p class="text-gray-600">
            <!-- You can output more details here, such as specifications, reviews, etc. -->
            {{$product->description}}
        </p>
    </div>
</div>
@endsection