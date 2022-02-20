<?php

namespace Bsdev\Shipping\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClusterRequest extends FormRequest
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
            'status' => 'nullable|in:1',
            'areas' => 'required',
            'areas.*' => 'exists:areas,id',
        ];
    }
}
