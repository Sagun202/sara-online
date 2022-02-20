<?php

namespace Bsdev\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
