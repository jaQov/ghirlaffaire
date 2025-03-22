<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home', [
            'featuredProducts' => Product::with('categories')
                ->Active()
                ->Featured()
                ->latest()
                ->take(4)->get(),
            'latestProducts' => Product::with('categories')
                ->Active()
                ->latest()
                ->take(8)->get(),
        ]);
    }
}
