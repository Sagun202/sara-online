<?php

namespace Bsdev\Ecommerce\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'slug' => 'nullable|string|max:255',
            'icon' => 'nullable|string',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif,webp|max:2048',
            'short_description' => 'nullable|string',
            'status' => 'nullable|in:1',
            'show_in_home' => 'nullable|in:1',
            'position' => 'nullable|integer',
            'category_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:2000',
        ];
    }
}
