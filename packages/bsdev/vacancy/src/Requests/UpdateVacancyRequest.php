<?php

namespace Bsdev\Vacancy\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacancyRequest extends FormRequest
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
            'type' => 'required|in:Part Time, Full Time',
            'no_of_opening' => 'required|integer|min:1',
            'short_description' => 'required|string',
            'expire_at' => 'required|date|after_or_equal:today',
            'description' => 'required',
            'status' => 'nullable|in:1',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:2000',
        ];
    }
}
