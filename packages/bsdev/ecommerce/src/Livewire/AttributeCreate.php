<?php

namespace Bsdev\Ecommerce\Livewire;

use Bsdev\Ecommerce\Models\Attribute;
use Livewire\Component;

class AttributeCreate extends Component
{
    public $name;
    public $status = 1;
    public $values = [null];
    public $categories;
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'values.*' => 'required|string',
            'categories.*' => 'required|exists:categories,id',
            'status' => 'required|in:0,1',
        ];
    }

    public function save()
    {
        $this->validate();
        try {
            $attribute = Attribute::create([
                'name' => $this->name,
                'slug' => \Illuminate\Support\Str::slug($this->name),
                'status' => $this->status,
            ]);
            $valuesArray = [];
            foreach ($this->values as $val) {
                $valuesArray[]['name'] = $val;
            }
            $attribute->values()->createMany($valuesArray);
            $attribute->categories()->sync($this->categories);
            session()->flash('success', 'Created Successfully!!');

            return redirect()->route('attributes.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {
            $this->addError(
                'error', 'Something went wrong!!',
            );
        }

    }
    public function render()
    {
        return view('ecommerce::livewire.attribute-create');
    }

    public function add()
    {
        $this->values[] = null;
    }
    public function remove($count)
    {
        unset($this->values[$count]);
    }
}
