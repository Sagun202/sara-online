<?php

namespace Bsdev\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostComment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'post_id',
        'name',
        'email',
        'message',
        'user_id',
        'status',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
