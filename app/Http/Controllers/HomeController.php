<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();

        // Using model scopes for cleaner code
        $featuredProducts = Product::featured()->get();
        $discountedProducts = Product::discounted()->get();

        return view('pages.home', compact('featuredProducts', 'discountedProducts'));
    }
}
