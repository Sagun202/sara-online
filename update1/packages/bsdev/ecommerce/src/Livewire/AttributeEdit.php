<?php

namespace Bsdev\Ecommerce\Livewire;

use Bsdev\Ecommerce\Models\Attribute;
use Livewire\Component;

class AttributeEdit extends Component
{
    public $attribute;
    public $name;
    public $key = 9999999;
    public $status = 1;
    public $values = [null, null];
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
    public function mount()
    {
        $this->name = $this->attribute->name;
        $this->status = $this->attribute->status;
        $this->categories = $this->attribute->categories()->pluck('categories.id')->toArray();
        $this->values = $this->attribute->values()->pluck('name', 'id')->toArray();
    }

    public function save()
    {
        $this->validate();
        try {
            $this->attribute->update([
                'name' => $this->name,
                'slug' => \Illuminate\Support\Str::slug($this->name),
                'status' => $this->status,
            ]);
            // $valuesArray = [];
            foreach ($this->values as $key => $val) {
                $valuesArray =
                    [
                    'id' => $key,
                    'name' => $val,
                ];
                $this->attribute->values()->updateOrCreate($valuesArray);
            }

            $this->attribute->categories()->sync($this->categories);
            session()->flash('success', 'Updated Successfully!!');

            return redirect()->route('attributes.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {
            $this->addError(
                'error', 'Something went wrong!!' . $ex->getMessage(),
            );
        }

    }
    public function render()
    {
        return view('ecommerce::livewire.attribute-create');
    }

    public function add()
    {
        $this->key++;

        $this->values[$this->key] = null;
    }
    public function remove($count)
    {

        $res = \Bsdev\Ecommerce\Models\Variation::whereJsonContains('conf->' . $this->attribute->id, (string) $count)->get();

        if (count($res) > 0) {
            $this->addError(
                'error', 'Cannot delete products has it value!!'
            );
        } else {

            \Bsdev\Ecommerce\Models\AttributeValue::find($count)->delete();
            unset($this->values[$count]);
        }
    }
}
