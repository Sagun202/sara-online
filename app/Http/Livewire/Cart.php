<?php

namespace App\Http\Livewire;

use FrontEndHandler;
use Livewire\Component;

class Cart extends Component
{
    public $items;
    protected $listeners = ['update_cart' => 'mount'];
    public function mount()
    {

        $this->items = FrontEndHandler::getCart()->cart_items()->where('order_id', null)->get();
    }
    public function render()
    {
        return view('livewire.cart');
    }
}
