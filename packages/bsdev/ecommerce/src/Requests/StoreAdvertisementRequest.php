<?php

namespace Bsdev\Ecommerce\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertisementRequest extends FormRequest
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

            'position' => 'nullable|integer|min:1',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|mimes:png,jpg,jpeg,gif,webp,svg',
            'link' => 'nullable|string',
            'status' => 'nullable|in:1',
            'button_text' => 'nullable|string|max:255',
            'expire_at' => 'nullable|date',
        ];
    }
}
