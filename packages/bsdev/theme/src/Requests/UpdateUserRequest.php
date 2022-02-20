<?php

namespace Bsdev\Theme\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'nullable|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|min:6|max:20|string',
            'featured'=>'nullable|in:1'
        ];
    }
}
