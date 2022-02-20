<?php

namespace Bsdev\Team\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'position',
        'status',
        'designation_id',
    ];

    public function designation()
    {

        return $this->belongsTo(Designation::class);

    }
    public function designations()
    {

        return $this->hasMany(Designation::class, 'designation_id');
    }

    public function teams()
    {

        return $this->hasMany(Team::class)->orderBy('position', 'ASC');
    }

}
