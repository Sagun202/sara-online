<?php

namespace App\Http\Livewire;

use Bsdev\Ecommerce\Models\ProductReview;
use Livewire\Component;

class Review extends Component
{
    public $product;
    public $name;
    public $review;
    public $rate;
    public $reviews;
    public $rules = [
        'name' => 'required|string|max:255',
        'review' => 'required|string|max:2000',
        'rate' => 'required|min:1|max:5',
    ];
    public function mount()
    {
        if (auth()->check()) {
            $this->name = auth()->user()->name;
        }
        $this->reviews = ProductReview::where('product_id', $this->product->id)->orderBy('updated_at', 'DESC')->where('status',1)->get();
    }
    public function save()
    {
        $this->validate();
        ProductReview::create([
            'user_id' => (auth()->check()) ? auth()->user()->id : null,
            'name' => $this->name,
            'review' => $this->review,
            'rate' => $this->rate,
            'product_id' => $this->product->id,
        ]);
        $this->alert('success', 'Successfull Your review is under reviewing process!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ]);
        $this->review = null;
        $this->rate = null;
        return true;
    }

    public function render()
    {
        return view('livewire.review');
    }
}
