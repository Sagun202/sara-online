<?php

namespace Bsdev\Post\Models;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'type_id',
        'seo',
        'status',
        'position',
        'gallery',
        'user_id',
        'likes',
        'views',
        'post_id',
        'icon'
    ];

    protected $casts = [
        'seo' => 'array',
        'gallery' => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
