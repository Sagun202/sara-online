<?php

namespace App\Http\Livewire;

use App\Models\WishList as Wish;
use Livewire\Component;

class WishList extends Component
{
    public $product;
    public function render()
    {
        return view('livewire.wish-list');
    }
    public function addToWishList()
    {
        if (!auth()->check()) {
            $this->alert('error', 'Please Login before adding to cart!!!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => '',
            ]);
        }
        $check = Wish::where('user_id', auth()->id())->where('product_id', $this->product->id)->first();
        if (!$check) {
            Wish::create([
                'user_id' => auth()->id(),
                'product_id' => $this->product->id,
            ]);
            $this->alert('success', 'Successfully Added!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => '',
            ]);

            return true;
        }
        $this->alert('error', 'Already Exists!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ]);

    }
}
