<?php

namespace App\Observers;

use App\Models\DeliveryCompany;
use App\Models\Wilaya;
use App\Models\DeliveryPrice;

class DeliveryCompanyObserver
{
    /**
     * Handle the DeliveryCompany "created" event.
     */
    public function created(DeliveryCompany $company): void
    {
        // Retrieve all 58 wilayas
        $wilayas = Wilaya::pluck('wilaya_code');

        // Insert default delivery prices for each wilaya
        foreach ($wilayas as $wilaya_code) {
            DeliveryPrice::create([
                'wilaya_code' => $wilaya_code,
                'company_id'  => $company->id,
                'door'        => 0, // Default price for "door"
                'stopdesk'    => 0, // Default price for "stopdesk"
            ]);
        }
    }

    /**
     * Handle the DeliveryCompany "updated" event.
     */
    public function updated(DeliveryCompany $deliveryCompany): void
    {
        //
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
