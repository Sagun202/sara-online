<?php

namespace Bsdev\Ecommerce\Requests;

use Bsdev\Ecommerce\Models\Category;
use Bsdev\Ecommerce\Models\CustomField;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $rules = [
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:2000',
            'short_description' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:1',
            'cost_price' => 'required|integer|min:1',
            'discount' => 'nullable|integer',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'nullable|in:1',
            'featured' => 'nullable|in:1',
            'quantity' => 'required|integer|min:0',
            'categories.*' => 'exists:categories,id',
            'weight' => 'required|integer',
            'images.*' => 'nullable|string',

        ];

        if ($this->categories) {
            $categories = Category::find($this->categories);
            $fields = [];
            foreach ($categories as $category) {
                foreach ($category->custom_fields()->where('status', 1)->get() as $field) {
                    if (!in_array($field->id, $fields)) {
                        $fields[] = $field->id;
                    }
                }
            }
            $fields = CustomField::find($fields);
            foreach ($fields as $field) {
                if ($field->type == "checkbox") {

                    $rules['field.' . $field->id] = ($field->required) ? 'required|array|min:1' : 'nullable';

                } elseif ($field->type == "file") {

                    $rules['field.' . $field->id] = ($field->required) ? 'nullable' : 'nullable';

                } else {

                    $rules['field.' . $field->id] = ($field->required) ? 'required|string|max:255' : 'nullable';
                }
            }
        }
        return $rules;
    }
    public function messages()
    {
        $message = [];
        if ($this->categories) {
            $categories = Category::find($this->categories);
            $fields = [];
            foreach ($categories as $category) {
                foreach ($category->custom_fields()->where('status', 1)->get() as $field) {
                    if (!in_array($field->id, $fields)) {
                        $fields[] = $field->id;
                    }
                }
            }
            $fields = CustomField::find($fields);
            foreach ($fields as $field) {
                $message['field.' . $field->id . '.required'] = $field->title . ' is required';
            }

        }
        return $message;

    }
}
