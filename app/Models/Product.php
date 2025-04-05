<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

 

    public function calculateDiscount()
    {
        if (!$this->compare_at_price || $this->compare_at_price <= $this->price) {
            return null; // No discount
        }

        return round((($this->compare_at_price - $this->price) / $this->compare_at_price) * 100);
    }

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

    protected $casts = [
        'status' => 'boolean',
        'tags' => 'array',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
            ->where('status', '1')
            ->latest();
    }

    public function scopeDiscounted($query)
    {
        return $query->whereNotNull('compare_at_price')
            ->whereColumn('compare_at_price', '>', 'price')
            ->where('status', '1')
            ->latest();
    }
};
