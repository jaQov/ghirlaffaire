<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CatalogController extends Controller
{
    /**
     * Display the catalog of products with optional filters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Base query for active products
        $query = Product::with('categories')->where('status', true);

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by category using many-to-many relationship
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by tag (stored as JSON)
        if ($request->filled('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }

        // Paginate results
        $products = $query->latest()->paginate(12);

        // Get all categories for the filter dropdown
        $categories = Category::all();

        return view('pages.catalog', [
            'products'   => $products,
            'categories' => $categories,
            'filters'    => $request->only(['search', 'category', 'min_price', 'max_price', 'tag']),
        ]);
    }
}
