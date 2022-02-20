<?php

namespace App\Models;

use Bsdev\Ecommerce\Models\Brand;
use Bsdev\Ecommerce\Models\Category;
use Bsdev\Ecommerce\Models\Order;
use Bsdev\Ecommerce\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'district',
        'area',
        'landmark',
        'image',
        'address',
        'address2'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function wish_lists()
    {
        return $this->hasMany(WishList::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
