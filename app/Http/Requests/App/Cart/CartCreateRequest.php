<?php

namespace App\Http\Requests\App\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:products,id',
        ];
    }
}
