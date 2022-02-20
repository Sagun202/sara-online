<?php

namespace App\Http\Livewire;

use Bsdev\Ecommerce\Models\Order;
use Livewire\Component;

class OrderList extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::where('user_id', auth()->id())->orderBy('updated_at', 'DESC')->with('cart_items')->get();
    }
    public function render()
    {
        return view('livewire.order-list');
    }
}
