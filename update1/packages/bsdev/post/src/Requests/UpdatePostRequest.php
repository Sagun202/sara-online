<?php

namespace Bsdev\Post\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'short_description' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,gif,jpeg,webp',
            'type_id' => 'required|exists:types,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'nullable|in:1',
            'position' => 'nullable|integer',
            'gallery' => 'nullable',
            'categories' => 'nullable|exists:categories,id',
            'post_id' => 'nullable|exists:posts,id',
            'icon' => 'nullable|string|max:255',

        ];
    }
}
