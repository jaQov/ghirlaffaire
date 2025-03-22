<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'commune_id',
        'product_id',
        'quantity',
        'delivery_method',
    ];

    /**
     * Get the client who placed the order.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the commune where the order is delivered.
     */
    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }

    /**
     * Get the product for this order.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Calculate total price based on product price and quantity
            $order->total_price = $order->product->price * $order->quantity;
        });

        static::created(function ($order) {
            // Update client statistics after order creation
            $order->client->updateClientStats();
        });

        static::deleted(function ($order) {
            // Update client stats if an order is deleted
            $order->client->updateClientStats();
        });
    }
}
