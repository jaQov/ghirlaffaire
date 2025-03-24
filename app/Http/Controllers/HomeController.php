<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('status', 1)
            ->where('featured', 1)
            ->latest()
            ->take(10)
            ->get();

        $onSaleProducts = Product::where('status', 1)
            ->where('featured', 0)
            ->whereNotNull('compare_at_price') // Check if compare_at_price is not null
            ->latest()
            ->take(10)
            ->get();

        return view('home', compact('featuredProducts', 'onSaleProducts'));
    }
}
