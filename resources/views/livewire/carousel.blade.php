<div class="overflow-hidden relative">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($products as $product)
            <div class="swiper-slide">
                <x-product-card :product="$product" />
            </div>
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let swiperInstance = new Swiper(".mySwiper", {
                loop: true,
                slidesPerView: {{ $settings['slidesPerView'] }},
                spaceBetween: 20,
                autoplay: {
                    delay: {{ $settings['autoplayDelay'] }},
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    0: { slidesPerView: 1 }, // 1 slide per view on mobile
                        640: { slidesPerView: 1 }, // 1 slide per view on mobile
                        768: { slidesPerView: 2 }, // 2 slides per view on tablet
                        1024: { slidesPerView: 4}, // Default for desktop
                },
            });

            // Reinitialize Swiper after Livewire updates
            Livewire.hook('message.processed', function () {
                swiperInstance.destroy(true, true); // Destroy existing instance
                swiperInstance = new Swiper(".mySwiper", {
                    loop: true,
                    slidesPerView: {{ $settings['slidesPerView'] }},
                    spaceBetween: 20,
                    autoplay: {
                        delay: {{ $settings['autoplayDelay'] }},
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpoints: {
                        0: { slidesPerView: 1 }, // 1 slide per view on mobile
                        640: { slidesPerView: 1 }, // 1 slide per view on mobile
                        768: { slidesPerView: 2 }, // 2 slides per view on tablet
                        1024: { slidesPerView: 4 }, // Default for desktop
                    },
                });
            });
        });
    </script>
</div>