<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartItem extends Component
{
    public $item;
    public $quantity;
    public $product;
    public function mount()
    {
        $this->product = $this->item->product;
        $this->quantity = $this->item->quantity;
    }
    public function getListeners()
    {
        return [
            'delete_' . $this->item->id => 'delete',
            'cancel_' . $this->item->id => 'cancel',
        ];
    }
    public function render()
    {
        return view('livewire.cart-item');
    }
    public function updated($propertyName)
    {
        if ($propertyName == "quantity") {
            if ($this->quantity <= $this->product->quantity) {
                $status = $this->item->update([
                    'quantity' => $this->quantity,
                ]);
                $this->alert('success', 'Successfully Updated!', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => '',
                ]);
                $this->emitUp('update_cart');
            } else {
                $this->alert('info', 'Max quantity has been reached!', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => '',
                ]);
            }
        }
    }

    public function clickRemove()
    {
        $this->confirm('Are you want to remove?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => "No",
            'onConfirmed' => 'delete_' . $this->item->id,
            'onCancelled' => 'cancel_' . $this->item->id,
        ]);
        return true;
    }
    public function delete()
    {
        $this->item->delete();
        $this->emitUp('update_cart');
        $this->alert(
            'success',
            'Successfully Removed!.'
        );
    }
    public function cancel()
    {

    }
}
