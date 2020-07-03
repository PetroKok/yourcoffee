<?php

namespace App\Http\Requests\Kitchen;

use Illuminate\Foundation\Http\FormRequest;

class KitchenCreateRequest extends FormRequest
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
            'title' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'city_id' => 'required|exists:cities,id',
            'delivery' => 'nullable|array',
        ];
    }
}
