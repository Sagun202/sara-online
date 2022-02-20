<?php

namespace Bsdev\Slider\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'short_description',
        'description',
        'position',
        'link',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function scopeVendor($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
