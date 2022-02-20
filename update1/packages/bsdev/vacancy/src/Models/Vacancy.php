<?php

namespace Bsdev\Vacancy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Vacancy extends Model
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
        'type',
        'no_of_opening',
        'short_description',
        'expire_at',
        'description',
        'status',
        'seo',
    ];

    protected $casts = [
        'seo' => 'array',
    ];
}
