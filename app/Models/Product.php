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

    // Helper method to calculate the discount percentage
    public function calculateDiscount(): int
    {
        if ($this->compare_at_price && $this->compare_at_price > $this->price) {
            return round((($this->compare_at_price - $this->price) / $this->compare_at_price) * 100);
        }
        return 0;
    }

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
};
