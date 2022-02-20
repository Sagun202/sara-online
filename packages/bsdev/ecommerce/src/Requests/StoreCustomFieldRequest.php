<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomFieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'required:in' . implode(',', \Ecommerce\Models\CustomField::TYPES),
            'required' => 'nullable|in:1',
            'status' => 'nullable|in:1',
            'placeholder' => 'required|string|max:255',
            'values.*' => 'nullable|array',
        ];
    }
}
