<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'total_orders',
        'amount_spent',
        'ip_address',
        'note',
    ];

    protected $casts = [
        'total_orders' => 'integer',
        'amount_spent' => 'integer',
    ];

    /**
     * Get the orders for the client.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function updateClientStats()
    {
        $this->update([
            'amount_spent' => $this->orders()->sum('total_price'),
            'total_orders' => $this->orders()->count(),
        ]);
    }
}
