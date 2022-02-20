<?php

namespace Bsdev\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'attribute_id',
        'name',
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
