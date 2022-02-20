<?php

namespace Bsdev\Ecommerce\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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

            'payment_status' => 'nullable|in:1',
            'order_status' => 'integer|in:1,2,3,4,5',
        ];
    }
}
