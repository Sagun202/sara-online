<?php

namespace Bsdev\Team\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'designation_id',
        'image',
        'introduction',
        'user_id',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'linkedin',
        'website',
        'status',
        'position',
    ];

    public function designation()
    {

        return $this->belongsTo(Designation::class);
    }

}
