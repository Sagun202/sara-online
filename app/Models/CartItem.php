<?php

namespace App\Models;

use Bsdev\Ecommerce\Models\Attribute;
use Bsdev\Ecommerce\Models\Variation;
use Ecommerce\MiniCommerce\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
        'discount',
        'order_id',
        'attribute_ids',
        'variations',
        'variation_id',
    ];

    protected $casts = [
        'attribute_ids' => 'array',
        'variations' => 'array',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(\Bsdev\Ecommerce\Models\Product::class);
    }

    public function order()
    {
        return $this->belongsTo(\Bsdev\Ecommerce\Models\Order::class);
    }
    public function getAttributeArray()
    {
        return Attribute::whereIn('id', $this->attribute_ids)->where('status', 1)->with('values')->get();
    }
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}
