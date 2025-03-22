<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'compare_at_price',
        'status',
        'inventory',
        'category',
        'image_url',
        'tags',
    ];


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeActive($query)
    {
        $query->where('status', true);
    }
    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }



    protected $casts = [
        'status' => 'boolean',
        'tags' => 'array',
    ];
};
