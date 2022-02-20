<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use FrontEndHandler;
use Livewire\Component;

class SingleAddToCart extends Component
{
    public $product;
    public $quantity = 1;
    
    public function mount($product){
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.single-add-to-cart');
    }
    public function addToCart()
    {
        $cart = FrontEndHandler::getCart();
        if ($this->product->has_variation) {
            $this->alert('info', 'Product has variations please choose need combination');
            return redirect()->route('product.detail', $this->product->slug);
        } else {
            if ($this->product->quantity < $this->quantity) {
                $this->alert('info', 'Product is out of stock');
                return false;
            }
            $cartitem = CartItem::where('cart_id', $cart->id)->where('product_id', $this->product->id)->where('order_id', null)->first();
            if ($cartitem) {
                $this->alert('info', 'Product already in your cart!!');
                return false;
            }
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
            ]);
            $this->alert('success', 'Successfully Added To Cart!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => '',
            ]);
            $this->emit('refresh');
            return true;
        }
    }
}
