@props(['products'])

<div class="featured-carousel">
    <h2 class="text-3xl font-bold mb-4">Featured Products</h2>
    @livewire('carousel', ['products' => $products])
</div>