<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\DeliveryPrice;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'commune_id',
        'product_id',
        'quantity',
        'delivery_method',
        'total_price',
        'status',
        'ip_address',
    ];

    protected $with = ['commune.wilaya', 'client', 'product'];


    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function calculateDeliveryPrice()
    {
        $delivery = DeliveryPrice::where('wilaya_code', $this->commune?->wilaya?->wilaya_code)->first();

        return $delivery ? ($this->delivery_method === 'Door' ? $delivery->door : $delivery->stopdesk) : 0;
    }
}
