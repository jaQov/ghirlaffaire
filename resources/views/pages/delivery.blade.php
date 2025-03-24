@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

    @if($deliveryCompany)
        <!-- Delivery Partner Information Card -->
        <div class="bg-white shadow-lg rounded-lg p-6 text-center max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900">Delivery Prices</h1>
            <p class="mt-2 text-lg text-gray-700">
                Our delivery partner, <strong class="text-green-600">{{ $deliveryCompany->name }}</strong>, ensures fast and reliable shipping.
            </p>
            <div class="mt-4 flex justify-center">
                <img src="{{ asset('storage/' . $deliveryCompany->image_url) }}" 
                     alt="{{ $deliveryCompany->name }}" 
                     class="w-48 h-auto rounded-lg shadow-md border">
            </div>
        </div>

        <!-- Delivery Prices Table -->
        <div class="mt-8 bg-gray-100 p-6 rounded-lg shadow-lg">
            <table class="w-full border-collapse overflow-hidden rounded-lg">
                <thead>
                    <tr class="bg-green-700 text-white text-lg">
                        <th class="px-4 py-3">Wilaya Code</th>
                        <th class="px-4 py-3">Wilaya Name (Arabic)</th>
                        <th class="px-4 py-3">Wilaya Name (French)</th>
                        <th class="px-4 py-3">Door Delivery</th>
                        <th class="px-4 py-3">StopDesk Delivery</th>
                        <th class="px-4 py-3">Avg. Delivery Time</th>
                    </tr>
                </thead>
                <tbody class="text-center text-gray-900 text-lg">
                    @forelse ($deliveryPrices as $price)
                        <tr class="bg-white even:bg-gray-50 border-b">
                            <td class="px-4 py-3 font-semibold">{{ $price->wilaya->wilaya_code }}</td>
                            <td class="px-4 py-3">{{ $price->wilaya->wilaya_name_ar }}</td>
                            <td class="px-4 py-3">{{ $price->wilaya->wilaya_name_fr }}</td>
                            <td class="px-4 py-3 font-medium text-green-700">{{ ($price->door) }} DA</td>
                            <td class="px-4 py-3 font-medium text-green-700">{{ ($price->stopdesk) }} DA</td>
                            <td class="px-4 py-3 font-semibold text-gray-700">24-48h</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No delivery prices available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <!-- No Delivery Company Found -->
        <div class="text-center py-12 bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800">No Delivery Partner Found</h2>
            <p class="mt-2 text-lg text-gray-600">We currently do not have any delivery company available.</p>
        </div>
    @endif
</div>
@endsection
