<?php

namespace Bsdev\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomField extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'required',
        'values',
        'placeholder',
        'status',
        'position',
    ];

    protected $casts = [
        'values' => 'array',
    ];

    public const TYPES = [
        'text',
        'textarea',
        'select',
        'radio',
        'checkbox',
        'file',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
