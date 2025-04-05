<?php

namespace App\Livewire;

use Livewire\Component;

class Carousel extends Component
{
    public $products = [];
    public $settings = [
        'slidesPerView' => 3,
        'autoplayDelay' => 3000,
    ];

    public function mount($products)
    {
        $this->products = $products;
    }

    public function render()
    {
        return view('livewire.carousel');
    }
}
