<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    protected $primaryKey = 'wilaya_code'; // Define the primary key
    public $incrementing = false; // Since wilaya_code is not auto-incremented
    protected $fillable = ['wilaya_code', 'wilaya_name_ar', 'wilaya_name_fr'];
}
