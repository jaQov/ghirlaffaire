<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wilaya;

class ProductController extends Controller
{

    /**
     * Display the specified product by slug.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Get the product by slug or fail
        $product = Product::where('slug', $slug)->firstOrFail();

        // Get all wilayas for the order form dropdown
        $wilayas = Wilaya::all();

        return view('pages.product-details', [
            'product'  => $product,
            'wilayas'  => $wilayas,
            'discount' => $product->calculateDiscount(), // Use model method
        ]);
    }
}
