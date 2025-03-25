@props(['product', 'wilayas'])

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <!-- Full Name -->
    <x-form.input type="text" name="full_name" label="Full Name" required />

    <!-- Phone -->
    <x-form.input type="text" name="phone" label="Phone" required />

    <!-- Confirm Phone -->
    <x-form.input type="text" name="confirm_phone" label="Confirm Phone" required />

    <!-- Wilaya Selection -->
    <x-form.select name="wilaya_code" label="Wilaya" :options="$wilayas->pluck('wilaya_name_fr', 'wilaya_code')"
        @change="updateCommunes()" required />

    <!-- Commune Selection (Will be dynamically loaded) -->
    <x-form.select name="commune_id" label="Commune" :options="[]" required />

    <!-- Delivery Method -->
    <x-form.radio name="delivery_method" label="Delivery Method"
        :options="['Door' => 'Door', 'StopDesk' => 'Stop Desk']" required />

    <!-- Hidden Product ID -->
    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <!-- Order Button -->
    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md">Place Order</button>
</form>