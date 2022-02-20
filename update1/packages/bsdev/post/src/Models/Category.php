<?php

namespace Bsdev\Post\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    protected $table = 'post_categories';

    protected $fillable = [
        'name',
        'slug',
        'short_introduction',
        'type_id',
        'image',
        'status',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
