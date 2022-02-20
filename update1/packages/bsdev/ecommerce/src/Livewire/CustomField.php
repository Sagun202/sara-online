<?php

namespace Bsdev\Ecommerce\Livewire;

use Bsdev\Ecommerce\Models\CustomField as Field;
use Livewire\Component;

class CustomField extends Component
{
    public $title;
    public $type;
    public $required = 0;
    public $status = 0;
    public $values = [];
    public $placeholder;
    public $position;
    public $categories = [];
    public $hasValues = false;
    public $valuesCount = 0;

    protected function rules()
    {
        return [

            'title' => 'required|string|max:255',
            'type' => 'required:in' . implode(',', Field::TYPES),
            'required' => 'nullable|in:0,1',
            'status' => 'nullable|in:0,1',
            'placeholder' => 'required|string|max:255',
            'values.*' => 'nullable|string',
            'categories.*' => 'nullable|exists:categories,id',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        if ($this->type == "select" || $this->type == "radio" || $this->type == "checkbox") {
            $this->hasValues = true;
            if (count($this->values) <= 0) {

                $this->values[] = null;
            }

        } else {
            $this->hasValues = false;
        }
    }

    public function render()
    {
        $this->emit('loadjs');
        return view('ecommerce::livewire.custom-field');
    }

    public function add()
    {
        $this->values[] = null;
    }
    public function remove($count)
    {
        unset($this->values[$count]);
    }

    public function save()
    {
        abort_if(!auth()->user()->can('custom_field_create'), 403);

        $data = $this->validate();
        if ($this->type == "select" || $this->type == "checkbox" || $this->type == "radio") {
            $field = Field::create([
                'title' => $this->title,
                'placeholder' => $this->placeholder,
                'required' => $this->required ?? 0,
                'type' => $this->type,
                'status' => $this->status ?? 0,
                'values' => $this->values,
                'position' => $this->position,
            ]);
        } else {
            $field = Field::create([
                'title' => $this->title,
                'placeholder' => $this->placeholder,
                'type' => $this->type,
                'required' => $this->required ?? 0,
                'status' => $this->status ?? 0,
                'position' => $this->position,
                'position' => $this->position,
            ]);
        }
        $field->categories()->sync($this->categories);
        session()->flash('success', 'Created Successfully!!');
        return redirect()->route('custom-fields.index');

    }
}
