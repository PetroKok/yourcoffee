<?php

namespace App\Http\Requests\Kitchen;

use Illuminate\Foundation\Http\FormRequest;

class KitchenUpdateRequest extends FormRequest
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
            'spot_id' => 'required|integer',
            'city_id' => 'required|exists:cities,id',
            'delivery' => 'nullable|array',
            'delivery.*.price_delivery' => 'required|numeric',
            'delivery.*.time_delivery' => 'nullable|numeric',
        ];
    }
}
