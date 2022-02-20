<?php

namespace Bsdev\Team\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:255',
            'position' => 'nullable|integer',
            'designation_id' => 'required|exists:designations,id',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif,webp',
            'introduction' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'gmail' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'status' => 'nullable|in:1',
        ];
    }
}
