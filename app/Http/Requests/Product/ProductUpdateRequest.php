<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $locales = config('translatable.locales');

        $rules = [
            'category_id' => 'required|exists:categories,id',
            'ingredient_ids.*' => 'required|exists:ingredients,id',
            'price' => 'required'
        ];

        foreach ($locales as $locale) {
            $rules[$locale . '.name'] = 'required';
            $rules[$locale . '.description'] = 'required';
        }

        return $rules;
    }
}
