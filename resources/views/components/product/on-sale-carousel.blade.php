@props(['products'])

<div class="on-sale-carousel">
    <h2 class="text-3xl font-bold mb-4">On Sale Products</h2>
    @livewire('carousel', ['products' => $products])
</div>