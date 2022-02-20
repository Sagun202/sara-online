<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use Bsdev\Ecommerce\Models\AttributeValue;
use FrontEndHandler;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public $has_variation;
    public $attributes;
    public $variations;
    public $selected = [];
    public $modifiedVariations = [];
    public $hightlightClasses = [];
    public $selectedVari;
    public $confArray = [];
    public $quantity = 1;
    public $title;
    public $images;
    public $price;
    public function mount()
    {
        $this->has_variation = $this->product->has_variation;
        if ($this->has_variation) {
            $this->attributes = $this->product->getAttributeArray();
            $this->variations = $this->product->variations;
            $this->formulateVariation();
            $this->getConfArray();
        }
        $this->title = $this->product->title;
        $this->price = $this->product->price;

    }
    public function render()
    {
        return view('livewire.product-detail');
    }
    public function getConfArray()
    {
        foreach ($this->variations as $variation) {
            $this->confArray[] = $variation->conf;
        }
    }
    public function formulateVariation()
    {
        $modify = [];
        foreach ($this->attributes as $key => $attribute) {
            $modify[$key]['id'] = $attribute->id;
            $modify[$key]['name'] = $attribute->name;
            foreach ($this->variations as $varKey => $variation) {
                foreach ($variation->conf as $attributeKey => $attributeVal) {
                    if ($attributeKey == $attribute->id) {
                        $value = AttributeValue::find($attributeVal);
                        if ($value) {

                            $modify[$key]['values'][$varKey]['id'] = $value->id;
                            $modify[$key]['values'][$varKey]['name'] = $value->name;
                        }

                    }
                }
            }
        }

        $this->filterUnique($modify);
    }
    public function filterUnique($modify)
    {

        $remodify = [];
        foreach ($modify as $key => $mod) {
            $remodify[$key]['id'] = $mod['id'];
            $remodify[$key]['name'] = $mod['name'];
            $remodify[$key]['values'] = array_map("unserialize", array_unique(array_map("serialize", $mod['values'])));
        }
        $this->modifyVariations = $remodify;
    }
    public function select($attributeKey, $attributeVal)
    {
        $this->hightlightClasses = [];
        $variationsArray = [];
        $matchArray = [];
        foreach ($this->variations as $key => $variation) {
            $variationsArray[] = $variation->conf;
            if ($this->keyValueMatch($variation->conf, $attributeKey, $attributeVal)) {
                $matchArray[] = $variation->conf;
            }
        }
        $selected = [];
        $class = 'highlight_' . $attributeKey . '_' . $attributeVal;
        $this->hightlightClasses[] = $class;
        $this->selected[$attributeKey] = $attributeVal;
        $allSelected = [];
        foreach ($matchArray as $key => $val) {
            if ($val[$attributeKey] == $attributeVal) {

                foreach ($val as $k => $v) {
                    if ($k != $attributeKey && $v != $attributeVal) {
                        if (isset($this->selected[$k])) {
                            if ($val[$k] != $this->selected[$k]) {

                                $allMatchClass = 'highlight_' . $k . '_' . $v;
                                $allSelected[] = $allMatchClass;

                                $this->selected[$k] = intval($v);
                            }
                        } else {
                            $allMatchClass = 'highlight_' . $k . '_' . $v;
                            $allSelected[] = $allMatchClass;

                            $this->selected[$k] = intval($v);
                        }
                    }
                }
            }
        }
        foreach ($this->selected as $seK => $seV) {
            $matchClass = 'highlight_' . $seK . '_' . $seV;
            $this->hightlightClasses[] = $matchClass;
        }
        $this->fetchVariation();

    }

    public function keyValueMatch($arr, $key, $val)
    {
        if (array_key_exists($key, $arr) && $arr[$key] == $val) {
            return true;
        }
        return false;
    }

    public function addToCart()
    {
        $cart = FrontEndHandler::getCart();
        if ($this->has_variation) {
            if (count($this->selected) <= 0) {

                $this->alert('info', 'Please select attributes before adding to cart!!');
                return false;
            } else {
                $cartitem = CartItem::where('cart_id', $cart->id)->where('product_id', $this->product->id)->where('order_id', null)->first();

                if ($cartitem) {
                    $this->alert('info', 'Product already in your cart!!');
                    return false;
                }
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $this->product->id,
                    'quantity' => $this->quantity,
                    'attribute_ids' => $this->attributes->pluck('id')->toArray(),
                    'variations' => $this->selected,
                    'variation_id' => $this->selectedVari->id,
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
        } else {
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
    public function increaseQty()
    {
        if ($this->has_variation) {
            if (count($this->selected) <= 0) {
                $this->alert('info', 'Please select attributes first');
                return false;
            } else {
                if ($this->quantity < $this->selectedVari->quantity) {
                    $this->quantity++;
                    return false;
                } else {
                    $this->alert('info', 'Max availiable is ' . $this->selectedVari->quantity);
                    return false;
                }
            }
        }
        if ($this->product->quantity > $this->quantity) {
            $this->quantity++;
        } else {
            $this->alert('info', 'Max availiable is ' . $this->product->quantity);
        }

    }
    public function decreaseQty()
    {
        if ($this->quantity != 1) {
            $this->quantity--;
        }
    }

    public function fetchVariation()
    {
        foreach ($this->variations as $veri) {
            if ($this->selected == $veri->conf) {
                $this->selectedVari = $veri;
                $this->title = $veri->title;
                $this->price = $veri->price;
                // $this->quantity = $veri->quantity;
                break;
            }
        }
    }

}
