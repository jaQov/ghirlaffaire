<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Show the product details page.
     */
    public function show($id)
    {
        // Retrieve the product by ID
        $product = Product::findOrFail($id);

        // Return the product details view with the product data
        return view('products.details', compact('product'));
    }
}
