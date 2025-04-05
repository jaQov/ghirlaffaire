<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCompany;

class DeliveryController extends Controller
{
    public function index()
    {
        $company = DeliveryCompany::with('deliveryPrices.wilaya')
            ->where('is_active', true)
            ->first();

        if (!$company) {
            abort(404, 'No active delivery company found.');
        }

        return view('pages.delivery', compact('company'));
    }
}
