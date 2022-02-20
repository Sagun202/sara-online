<?php

namespace App\Http\Livewire;

use FrontEndHandler;
use Livewire\Component;

class CartCounter extends Component
{
    public $items;
    protected $listeners = ['refresh' => 'render'];
    public function render()
    {
        $this->items = FrontEndHandler::getCart()->cart_items()->where('order_id', null)->count();
        return view('livewire.cart-counter');
    }
}
