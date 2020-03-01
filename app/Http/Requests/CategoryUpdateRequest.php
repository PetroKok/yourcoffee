<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'parent_id' => 'nullable|exists:categories,id',
            'position' => 'required|integer',
            'image' => 'sometimes|required|file'
        ];

        foreach ($locales as $locale) {
            $rules[$locale . '.title'] = 'required';
        }

        return $rules;
    }
}