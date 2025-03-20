<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryCompany extends Model
{
    use HasFactory;

    protected $table = 'delivery_companies';

    public $timestamps = true;

    protected $fillable = [
        'name', // Add other company-related fields here
    ];


    // Define the relationship
    public function deliveryPrices()
    {
        return $this->hasMany(DeliveryPrice::class, 'company_id');
    }
}
