<?php

namespace App\Observers;

use App\Models\DeliveryCompany;
use App\Models\Wilaya;
use App\Models\DeliveryPrice;

class DeliveryObserver
{
    /**
     * Handle the DeliveryCompany "created" event.
     */
    public function created(DeliveryCompany $company): void
    {
        // Retrieve all 58 wilayas (assuming wilayas table holds them)
        $wilayas = Wilaya::pluck('wilaya_code');

        // Insert default delivery prices for each wilaya
        foreach ($wilayas as $wilaya_code) {
            DeliveryPrice::create([
                'wilaya_code'   => $wilaya_code,
                'company_id'    => $company->id,
                'door'          => 0, // Default price for "door"
                'stopdesk'      => 0, // Default price for "stopdesk"
                'delivery_time' => '24-48', // Default delivery time
            ]);
        }
    }

    /**
     * Handle the DeliveryCompany "updated" event.
     */
    public function updated(DeliveryCompany $deliveryCompany): void
    {
        // If the delivery company is marked as active,
        // deactivate all other companies.
        if ($deliveryCompany->is_active) {
            DeliveryCompany::where('id', '!=', $deliveryCompany->id)
                ->update(['is_active' => false]);
        }
    }

    /**
     * Handle the DeliveryCompany "deleted" event.
     */
    public function deleted(DeliveryCompany $deliveryCompany): void
    {
        //
    }

    /**
     * Handle the DeliveryCompany "restored" event.
     */
    public function restored(DeliveryCompany $deliveryCompany): void
    {
        //
    }

    /**
     * Handle the DeliveryCompany "force deleted" event.
     */
    public function forceDeleted(DeliveryCompany $deliveryCompany): void
    {
        //
    }
}
