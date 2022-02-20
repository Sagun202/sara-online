<?php

namespace Bsdev\Ecommerce\Livewire;

use Bsdev\Ecommerce\Models\Attribute;
use Bsdev\Ecommerce\Models\Variation;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductAttributeEdit extends Component
{
    use WithFileUploads;
    protected $listeners = ['validateAttribute' => 'save'];
    public $attributes;
    public $is_valid = 0;
    public $selectedAttributes = [];
    public $finalAttribute;
    public $attributes_ids = [];
    public $key = 99999;
    public $attribute_values;
    public $hasAttribute = 0;
    public function mount()
    {
        $this->attributes = Attribute::all();
        $this->selectedAttributes = Attribute::find($this->attributes_ids);
        if (count($this->attribute_values) <= 0) {
            $this->attribute_values[] = [];
        }
    }

    public function render()
    {
        return view('ecommerce::livewire.product-attribute-edit');
    }

    public function updated($propertyName)
    {

        if ($propertyName === 'attributes_ids') {
            $this->selectedAttributes = Attribute::find($this->attributes_ids);
        }
    }

    public function addMore()
    {
        $this->attribute_values[] = [
            'id' => $this->key,
            'title' => null,
            'quantity' => null,
            'price' => null,
            'conf' => [
            ],
            'media' => [],
        ];
        $this->key++;
    }
    public function remove($i)
    {
        if (count($this->attribute_values) > 1) {
            $variation = Variation::find($this->attribute_values[$i]['id']);
            if ($variation) {
                $variation->delete();
            }
            unset($this->attribute_values[$i]);
        }
        // $this->layer--;
    }
    public function save()
    {
        if (!$this->hasAttribute) {
            return false;
        }
        $this->resetErrorBag();
        $newAttributes = [];
        $realKey = 0;
        foreach ($this->attribute_values as $key => $val) {
            $newAttributes[$realKey]['id'] = (!isset($val['id'])) ? $this->key++ : $val['id'];
            if ($val['title'] == null) {
                $this->addError('attribute_values.' . $key . '.title', 'Title Field is Required');
                return false;
            }
            $newAttributes[$realKey]['title'] = $val['title'];
            if ($val['quantity'] == null) {
                $this->addError('attribute_values.' . $key . '.quantity', 'Quautntiy Field is Required');
                return false;
            }
            $newAttributes[$realKey]['quantity'] = $val['quantity'];
            if ($val['price'] == null) {
                $this->addError('attribute_values.' . $key . '.price', 'Price Field is Required');
                return false;
            }
            $newAttributes[$realKey]['price'] = $val['price'];
            if (count($this->selectedAttributes) > count($val['conf'])) {

                $this->addError('attribute_values.' . $key . '.conf', 'Select All Options');
                return false;
            } elseif (count($this->selectedAttributes) < count($val['conf'])) {
                foreach ($val['conf'] as $valKey => $valVal) {

                    if (!in_array($valKey, $this->attributes_ids)) {
                        unset($val['conf'][$valKey]);
                    }
                }
            } else {
                foreach ($val['conf'] as $valKey => $valVal) {
                    if ($valKey == "" || $valVal == "") {

                        $this->addError('attribute_values.' . $key . '.conf', 'Select All Options');
                        return false;
                    }
                }
            }
            $newAttributes[$realKey]['conf'] = $val['conf'];
            $images = [];
            foreach ($val['media'] ?? [] as $media) {
                $images[] = $media->store('product', 'public');
            }
            foreach ($val['images'] ?? [] as $media) {
                $images[] = $media;
            }
            $newAttributes[$realKey]['images'] = $images;
            $realKey++;
        }
        $this->finalAttribute = $newAttributes;
        $encoded = json_encode($this->finalAttribute);
        $this->is_valid = 1;
        $this->emit('submit');
        return true;
    }

    public function removeImage($key, $image)
    {
        unset($this->attribute_values[$key]['images'][$image]);
    }
}
