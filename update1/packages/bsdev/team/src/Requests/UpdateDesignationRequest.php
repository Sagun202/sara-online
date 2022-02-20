<?php

namespace Bsdev\Team\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDesignationRequest extends FormRequest
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
            'position' => 'required|integer',
            'status' => 'nullable|in:1',
            'designation_id' => 'nullable|exists:designations,id',
        ];
    }
}
