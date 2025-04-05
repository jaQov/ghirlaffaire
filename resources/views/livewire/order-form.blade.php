<div class="p-6 bg-gray-100 shadow-lg rounded-lg">
    @if (session()->has('message'))
    <div class="mb-4 p-3 bg-green-100 text-green-900 rounded-lg">
        {{ session('message') }}
    </div>
    @endif

    <h2 class="text-2xl font-bold text-gray-900 mb-4">Order This Product</h2>

    <!-- Full Name -->
    <x-form.input label="Full Name" name="name" wire:model="name" placeholder="Enter your full name" />
    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

    <!-- Phone -->
    <x-form.input label="Phone" name="phone" wire:model="phone" placeholder="Enter your phone number" />
    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

    <!-- Confirm Phone -->
    <x-form.input label="Confirm Phone" name="confirmPhone" wire:model="confirmPhone"
        placeholder="Confirm your phone number" />
    @error('confirmPhone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

    <!-- Wilaya -->
    <x-form.select label="Wilaya" name="wilaya_code" wire:model="wilaya_code" wire:change="updateWilayaCodeHandler">
        <option value="">Select a Wilaya</option>
        @foreach($wilayas as $wilaya)
        <option value="{{ (int)$wilaya->wilaya_code }}">{{ $wilaya->wilaya_name_fr }}</option>
        @endforeach
    </x-form.select>
    @error('wilaya_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

    <!-- Commune -->
    <x-form.select label="Commune" name="commune_id" wire:model="commune_id">
        <option value="">Select a Commune</option>
        @foreach($communes as $commune)
        <option value="{{ $commune['id'] }}">{{ $commune['commune_name_fr'] }}</option>
        @endforeach
    </x-form.select>
    @error('commune_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

    <!-- Delivery Method using custom radio component -->
    <x-form.radio label="Delivery Method" name="delivery_method" wire:model.live="delivery_method"
        :options="['Door' => 'Door Delivery', 'StopDesk' => 'Pickup at Stop Desk']" />

    <!-- Summary -->
    <div class="p-4 bg-gray-200 rounded-lg mb-4">
        <p class="text-gray-900"><strong>Product Price:</strong> {{ number_format($product->price, 2) }} DZD</p>
        <p class="text-gray-900"><strong>Delivery Price:</strong> {{ number_format($deliveryPrice, 2) }} DZD</p>
        <p class="text-lg font-bold text-gray-900"><strong>Total:</strong> {{ number_format($totalPrice, 2) }} DZD</p>
    </div>

    <!-- Submit Button -->
    <x-form.cta-button wire:click="submitOrder">Buy Now</x-form.cta-button>
</div>