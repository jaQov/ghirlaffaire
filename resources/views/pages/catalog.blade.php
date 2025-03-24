@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Catalog</h1>

    {{-- Search Bar Component --}}
    <x-search-bar />

    {{-- Product Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4  mt-4">
        @foreach($products as $product)
        <div class="flex flex-col h-full">
            <x-product-card :product="$product" />
        </div>
        @endforeach
    </div>
</div>
@endsection