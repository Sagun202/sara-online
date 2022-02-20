<?php

namespace Bsdev\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'title',
        'description',
        'image',
        'link',
        'status',
        'button_text',
        'expire_at',
    ];

}
