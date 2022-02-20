<?php

namespace Bsdev\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
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
        'images',
        'short_description',
        'description',
        'price',
        'cost_price',
        'discount',
        'brand_id',
        'status',
        'featured',
        'quantity',
        'user_id',
        'seo',
        'weight',
        'sku',
        'thumbnail',
        'brand_id',
        'custom_fields',
        'tags',
        'has_variation',
        'attribute_ids',
    ];

    protected $casts = [
        'seo' => 'array',
        'images' => 'array',
        'custom_fields' => 'array',
        'tags' => 'array',
        'attribute_ids' => 'array',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }
    public function getAttributeArray()
    {

        return Attribute::whereIn('id', $this->attribute_ids)->where('status', 1)->get();
    }

    public function getDiscountedPriceAttribute($value)
    {
        return $this->price - $this->price * $this->discount / 100;
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function vendor()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
