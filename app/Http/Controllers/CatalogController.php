<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // Get categories for the filter dropdown
        $categories = Category::all();

        // Fetch products with filters
        $products = Product::when($request->search, function ($query, $search) {
            return $query->where('title', 'like', "%$search%");
        })
            ->when($request->category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($request->min_price, function ($query, $min_price) {
                return $query->where('price', '>=', $min_price);
            })
            ->when($request->max_price, function ($query, $max_price) {
                return $query->where('price', '<=', $max_price);
            })
            ->paginate(8);

        return view('pages.catalog', compact('products', 'categories'));
    }
}
