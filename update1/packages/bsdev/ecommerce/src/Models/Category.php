<?php

namespace Bsdev\Ecommerce\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'image',
        'short_description',
        'status',
        'show_in_home',
        'position',
        'category_id',
        'user_id',
        'seo',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function allChildrens()
    {
        return $this->hasMany(Category::class, 'category_id')->with('allChildrens');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'seo' => 'array',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function custom_fields()
    {
        return $this->belongsToMany(CustomField::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
}
