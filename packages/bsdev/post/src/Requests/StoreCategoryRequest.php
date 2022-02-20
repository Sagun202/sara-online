<?php

namespace Bsdev\Post\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'short_introduction' => 'nullable|string|max:500',
            'type_id' => 'required|exists:types,id',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif,webp',
            'status' => 'nullable|in:1',
        ];
    }
}
