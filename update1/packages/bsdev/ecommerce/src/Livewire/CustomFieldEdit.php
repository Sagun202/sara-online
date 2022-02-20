<?php

namespace Bsdev\Ecommerce\Livewire;

use Bsdev\Ecommerce\Models\CustomField as Field;
use Livewire\Component;

class CustomFieldEdit extends Component
{
    public $field;
    public $title;
    public $type;
    public $required = 0;
    public $status = 0;
    public $values = [];
    public $placeholder;
    public $categories = [];
    public $hasValues = false;

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
    public function mount()
    {
        $this->title = $this->field->title;
        $this->placeholder = $this->field->placeholder;
        $this->required = $this->field->required;
        $this->status = $this->field->status;
        $this->position = $this->field->position;
        $this->values = $this->field->values;
        $this->type = $this->field->type;
        $this->categories = $this->field->categories->pluck('id')->toArray();
        if ($this->type == "select" || $this->type == "checkbox" || $this->type == "radio") {
            $this->hasValues = true;
        }
    }

    public function render()
    {
        $this->emit('loadjs');

        return view('ecommerce::livewire.custom-field-edit');
    }

    public function add()
    {
        $this->values[] = null;
    }
    public function remove($count)
    {
        unset($this->values[$count]);
    }

    public function update()
    {
        abort_if(!auth()->user()->can('custom_field_update'), 403);

        $data = $this->validate();
        if ($this->type == "select" || $this->type == "checkbox" || $this->type == "radio") {
            $field = $this->field->update([
                'title' => $this->title,
                'placeholder' => $this->placeholder,
                'required' => $this->required ?? 0,
                'type' => $this->type,
                'status' => $this->status ?? 0,
                'values' => $this->values,
                'position' => $this->position,
            ]);
        } else {
            $field = $this->field->update([
                'title' => $this->title,
                'placeholder' => $this->placeholder,
                'type' => $this->type,
                'required' => $this->required ?? 0,
                'status' => $this->status ?? 0,
                'position' => $this->position,
                'position' => $this->position,
                'values' => null,
            ]);
        }
        $this->field->categories()->sync($this->categories);
        session()->flash('success', 'Updated Successfully!!');
        return redirect()->route('custom-fields.index');

    }
}
