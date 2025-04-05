@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <!-- Company Header -->
    <div class="mb-12 flex flex-col items-center">
        <img src="{{ asset('storage/' . $company->image_url) }}" alt="{{ $company->name }}"
            class="w-32 h-32 object-cover rounded-full shadow-lg">
        <h1 class="mt-4 text-4xl font-bold text-gray-800 text-center">{{ $company->name }}</h1>
    </div>

    <!-- Delivery Prices Table -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="mb-6 text-2xl font-semibold text-gray-700 text-center">Delivery Prices by Wilaya</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-blue-800 uppercase tracking-wider">
                            Wilaya Code
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-blue-800 uppercase tracking-wider">
                            Name (FR)
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-blue-800 uppercase tracking-wider">
                            Name (AR)
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-blue-800 uppercase tracking-wider">
                            Door Price (DZD)
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-blue-800 uppercase tracking-wider">
                            Stopdesk Price (DZD)
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-blue-800 uppercase tracking-wider">
                            Delivery Time
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($company->deliveryPrices as $price)
                    <tr class="odd:bg-blue-50 even:bg-white hover:bg-blue-100">
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                {{ $price->wilaya->wilaya_code ?? $price->wilaya_code }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700">
                            {{ $price->wilaya->wilaya_name_fr ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700">
                            {{ $price->wilaya->wilaya_name_ar ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700">
                            {{ $price->door}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700">
                            {{ $price->stopdesk }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700">
                            {{ $price->delivery_time }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection