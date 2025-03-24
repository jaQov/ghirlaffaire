@props(['products'])

@if($products->isNotEmpty())
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">🔥 On Sale Now</h2>

    <!-- Swiper Container -->
    <div class="swiper on-sale-products-swiper">
        <div class="swiper-wrapper">
            @foreach ($products as $product)
            <div class="swiper-slide">
                <x-product-card :product="$product" />
            </div>
            @endforeach
        </div>

        <!-- Navigation Buttons -->
        <div class="swiper-button-next text-green-600"></div>
        <div class="swiper-button-prev text-green-600"></div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>

<!-- Swiper Initialization Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
            new Swiper(".on-sale-products-swiper", {
                loop: true, // Infinite loop
                slidesPerView: 1, // Default for mobile
                spaceBetween: 20,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: { slidesPerView: 2 }, // Tablets
                    1024: { slidesPerView: 3 }, // Desktops
                    1280: { slidesPerView: 4 }, // Large screens
                },
            });
        });
</script>
@endif