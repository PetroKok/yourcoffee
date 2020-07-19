<?php

namespace App\Http\Requests\App\Order;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'phone' => 'required|numeric',
            'name' => 'required|string',
            'address' => 'nullable|string',

            'pay_type' => 'nullable|string',

            'apartment' => 'nullable|string',
            'entrance' => 'nullable|string',
            'floor' => 'nullable|numeric',
            'door_code' => 'nullable|numeric'
        ];

        if (is_numeric($this->city_id)) {
            $rules['city_id'] = 'required|exists:cities,id';
        } else {
            $rules['city_id'] = 'required|string';
        }

        if (!in_array(mb_strtoupper($this->pay_type), Order::PAY_TYPE)) {
            $rules['pay_type'] = 'required|numeric';
        }

        if (in_array(mb_strtoupper($this->order), Order::ORDER_TYPE)) {
            $order_type = Order::ORDER_TYPE[mb_strtoupper($this->order)];
            switch ($order_type) {
                case Order::ORDER_TYPE['DELIVERY']:
                    $rules['address'] = 'required|string';
                    break;
            }
        } else {
            $rules['order'] = 'required|numeric';
        }

        return $rules;
    }
}
