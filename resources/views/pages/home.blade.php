@extends('layouts.app')

@section('content')
<x-hero />

<x-featured-products-carousel :featuredProducts="$featuredProducts" />

<x-on-sale-products-carousel :products="$onSaleProducts" />
@endsection