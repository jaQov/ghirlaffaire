<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Wilaya;
use App\Models\Product;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string',
            'phone' => 'required|string',
            'confirm_phone' => 'required|string|same:phone',
            'wilaya_code' => 'required|exists:wilayas,wilaya_code',
            'commune_id' => 'required|exists:communes,id',
            'delivery_method' => 'required|in:Door,StopDesk',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'total_price' => 'required|numeric',
        ]);

        Order::create($validated);

        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}
