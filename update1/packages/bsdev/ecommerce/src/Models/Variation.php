<?php

namespace Bsdev\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Variation extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    protected $fillable = [
        'title',
        'slug',
        'quantity',
        'in_stock',
        'price',
        'discount',
        'conf',
        'images',
        'product_id',
    ];

    protected $casts = [
        'images' => 'array',
        'conf' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
