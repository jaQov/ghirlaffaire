<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPrice extends Model
{
    use HasFactory;

    protected $table = 'delivery_prices'; // Ensure this matches your database table name

    protected $primaryKey = 'wilaya_code'; // Specify the actual primary key
    public $incrementing = false; // Since wilaya_code is not auto-incrementing
    protected $keyType = 'int'; // Define the key type

    protected $fillable = [
        'wilaya_code',
        'door',
        'stopdesk',
        'delivery_time',
        'delivery_time',
        'company_id',

    ];

    public function company()
    {
        return $this->belongsTo(DeliveryCompany::class, 'company_id');
    }

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class, 'wilaya_code', 'wilaya_code');
    }
}
