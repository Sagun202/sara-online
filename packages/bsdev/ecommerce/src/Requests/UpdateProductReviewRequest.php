<?php

namespace Bsdev\Ecommerce\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductReviewRequest extends FormRequest
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
            'rate' => 'required|min:1|max:5',
            'review' => 'required|string',
            'status' => 'nullable|in:0,1',
        ];
    }
}
