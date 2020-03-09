<?php

namespace App\Http\Requests\Label;

use Illuminate\Foundation\Http\FormRequest;

class LabelUpdateRequest extends FormRequest
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
            'position' => 'required|integer',
            'color' => 'required|string'
        ];

        foreach ($locales as $locale) {
            $rules[$locale . '.name'] = 'required';
        }

        return $rules;
    }
}
