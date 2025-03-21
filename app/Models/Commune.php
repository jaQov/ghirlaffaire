<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = [
        'commune_name_ar',
        'commune_name_fr',
        'wilaya_code',
    ];

    /**
     * Get the wilaya this commune belongs to.
     */
    public function wilaya(): BelongsTo
    {
        return $this->belongsTo(Wilaya::class, 'wilaya_code', 'wilaya_code');
    }

    /**
     * Get the orders that belong to this commune.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
