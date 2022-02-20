<?php

namespace Bsdev\Ecommerce\Models;

use App\Models\CartItem;
use App\Models\User;
use Bsdev\Shipping\Models\Shipping;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping',
        'payment_status',
        'payment_method',
        'order_status',
        'shipping_id',
        'shipping_detail',
        'shipping_cost',
        'total',
    ];

    protected $casts = [
        'shipping_detail' => 'array',
        'shipping' => 'array',
    ];

    public function cart_items()
    {
        return $this->hasMany(CartItem::class)->with('product');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingDetail()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
}
