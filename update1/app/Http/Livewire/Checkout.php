<?php

namespace App\Http\Livewire;

use Bsdev\Ecommerce\Models\Order;
use Bsdev\Shipping\Models\Area;
use Bsdev\Shipping\Models\Cluster;
use Bsdev\Shipping\Models\District;
use Bsdev\Shipping\Models\Shipping;
use Bsdev\Shipping\Models\State;
use FrontEndHandler;
use Livewire\Component;

class Checkout extends Component
{
    public $items;
    public $states = [];
    public $districts = [];
    public $areas = [];
    public $state;
    public $district;
    public $shippingDetail;
    public $shippings = [];
    public $area;
    public $shipping;
    public $phone;
    public $landmark;
    public $cluser;
    public $not_found = false;
    public $payment_method;

    public $rules = [
        'area' => 'required|exists:areas,id',
        'shipping' => 'required|exists:shippings,id',
        'landmark' => 'required|string|max:100',
        'phone' => 'required|digits:10',
        'payment_method' => 'required|in:cod',
    ];

    private function calculateTotalWeight()
    {
        $totalWeight = 0;
        foreach ($this->items as $item) {
            $totalWeight += ($item->product->weight * $item->quantity);
        }
        return $totalWeight;
    }

    public function mount()
    {
        // $this->district = auth()->user()->district;
        // $this->area = auth()->user()->area;
        // $this->landmark = auth()->user()->landmark;
        $this->phone = auth()->user()->phone;
        $this->states = State::where('status', 1)->orderBy('position', 'ASC')->get();
        $this->items = FrontEndHandler::getCart()->cart_items()->where('order_id', null)->get();
    }
    public function render()
    {
        return view('livewire.checkout');
    }

    public function updated($propertyName)
    {
        $this->not_found = false;
        $this->validateOnly($propertyName);
        if ($propertyName == "state") {
            if ($this->state) {

                $this->districts = District::where('state_id', $this->state)->where('status', 1)->orderBy('position', 'ASC')->get();
            } else {
                $this->district = null;
                $this->area = null;
                $this->districts = [];
                $this->areas = [];
                $this->shippings = [];
            }
        }
        if ($propertyName == "district") {
            if ($this->district) {

                $this->areas = Area::where('district_id', $this->district)->orderBy('position', 'ASC')->get();
            } else {
                $this->areas = [];
                $this->area = null;
                $this->shippings = [];

            }
        }
        if ($propertyName == "area") {
            $this->shippings = [];
            if ($this->area) {
                $this->cluster = Area::find($this->area)->with(['clusters' => function ($query) {
                    $query->where('status', 1);
                }])->first();
                if (count($this->cluster->clusters) > 0) {
                    $clusters = $this->cluster->clusters->pluck('id');
                    $this->shippings = Shipping::whereHas('clusters', function ($query) use ($clusters) {
                        $query->whereIn('clusters.id', $clusters);
                    })->where('status', 1)->with('shipping_method')->where('shipping_param_min', '<=', $this->calculateTotalWeight())->where('shipping_param_max', '>=', $this->calculateTotalWeight())->get();
                    if (count($this->shippings) <= 0) {
                        $this->not_found = true;
                    }
                }
            }
        }
        if ($propertyName == "shipping") {
            $this->shippingDetail = Shipping::find($this->shipping);
        }
    }
    public function checkout()
    {
        if (count($this->shippings) <= 0) {
            $this->not_found = true;
            return false;
        }

        $this->validate();
        $cart = FrontEndHandler::getCart();
        $items = $cart->cart_items;
        if (count($items) <= 0) {
            return redirect()->route('index');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'shipping_id' => $this->shippingDetail->id,
            'shipping_detail' => [
                'State' => State::find($this->state)->name,
                'District' => District::find($this->district)->name,
                'Area' => Area::find($this->area)->name,
                'LandMark' => $this->landmark,
                'Phone' => $this->phone,
            ],
            'shipping' => '',
            'shipping_cost' => $this->shippingDetail->cost,
            'payment_status' => 0,
            'payment_method' => $this->payment_method,
            'total' => 0,
        ]);
        $total = 0;
        foreach ($this->items as $item) {
            $product = $item->product;
            if ($product->has_variation) {
                $item->variation->update([
                    'quantity' => $item->variation->quantity - $item->quantity,
                ]);
                $item->update([
                    'cart_id' => null,
                    'order_id' => $order->id,
                    'price' => ($item->variation->price - ($item->variation->price * $product->discount / 100)),
                ]);
                $total += ($item->variation->price - ($item->variation->price * $product->discount / 100)) * $item->quantity;
            } else {
                $product->update([
                    'quantity' => $product->quantity - $item->quantity,
                ]);
                $item->update([
                    'cart_id' => null,
                    'order_id' => $order->id,
                    'price' => $product->discounted_price,
                ]);
                $total += ($product->discounted_price) * $item->quantity;
            }
        }
        $order->update([
            'total' => $total,
        ]);

        $this->alert('success', 'Order Successful!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ]);
        return redirect()->route('index');

    }
}
