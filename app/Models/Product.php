<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'title',
        'subtitle',
        'primary_description',
        'sub_description',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function getPrimaryImageAttribute()
    {
        return $this->images->first();
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
};
