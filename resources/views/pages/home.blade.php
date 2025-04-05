@extends('layouts.app')

@section('content')

<x-home.hero />

<div class="container mx-auto p-6">
    <!-- Featured Products Carousel -->
    <x-featured-carousel :products="$featuredProducts" />

    <!-- On-Sale Products Carousel -->
    <x-onsale-carousel :products="$discountedProducts" />
</div>

@endsection