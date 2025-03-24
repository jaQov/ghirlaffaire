<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryCompany;

class DeliveryController extends Controller
{
    public function index()
    {
        // Get the first available delivery company
        $deliveryCompany = DeliveryCompany::with('deliveryPrices.wilaya')->first();

        // Get delivery prices for this company, including wilaya details
        $deliveryPrices = $deliveryCompany->deliveryPrices ?? [];

        return view('pages.delivery', compact('deliveryCompany', 'deliveryPrices'));
    }
}
