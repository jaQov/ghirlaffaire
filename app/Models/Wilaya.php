<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilaya extends Model
{
    protected $primaryKey = 'wilaya_code'; // Define the primary key

    public $incrementing = false; // Since wilaya_code is not auto-incremented

    protected $fillable = [
        'wilaya_code',
        'wilaya_name_ar',
        'wilaya_name_fr'
    ];

    /**
     * Get the communes that belong to this Wilaya.
     */
    public function communes(): HasMany
    {
        return $this->hasMany(Commune::class, 'wilaya_code', 'wilaya_code');
    }
}
