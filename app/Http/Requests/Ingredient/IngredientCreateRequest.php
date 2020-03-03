<?php

namespace App\Http\Requests\Ingredient;

use Illuminate\Foundation\Http\FormRequest;

class IngredientCreateRequest extends FormRequest
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
            'pic' => 'required|file',
            'image' => 'required|file'
        ];

        foreach ($locales as $locale) {
            $rules[$locale . '.name'] = 'required';
            $rules[$locale . '.description'] = 'required';
        }

        return $rules;
    }
}
