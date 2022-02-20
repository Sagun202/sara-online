<?php

namespace Bsdev\Slider\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'image' => 'required|mimes:png,jpg,jpeg,webp,gif|max:2048',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'position' => 'nullable|integer',
            'link' => 'nullable|string',
            'status' => 'nullable|in:0,1',

        ];
    }
}
