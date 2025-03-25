<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wilaya;

class ProductController extends Controller
{
    /**
     * Show the product details page.
     */
    public function show($slug)
    {
        // Retrieve product by slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Retrieve all Wilayas with their related Communes
        $wilayas = Wilaya::with('communes')->get();

        return view('pages.product-details', compact('product', 'wilayas'));
    }
}
