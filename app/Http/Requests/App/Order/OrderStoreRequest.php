<?php

namespace App\Http\Requests\App\Order;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'phone' => 'required|phone:UA',
            'name' => 'required|string',

            'city_id' => 'required|string',

            'address' => 'nullable|string',

            'comment' => 'nullable|string',

            'apartment' => 'nullable|string',
            'entrance' => 'nullable|string',
            'floor' => 'nullable|string',
            'door_code' => 'nullable|string',

            'order' =>
                'required|in:' . mb_strtolower(Order::ORDER_TYPE['DELIVERY']) .
                ',' . mb_strtolower(Order::ORDER_TYPE['SELF-PICKUP'])
        ];

        if (is_numeric($this->city_id)) {
            $rules['city_id'] = 'required|exists:cities,id';
        }

        if (in_array(mb_strtoupper($this->order), Order::ORDER_TYPE)) {
            $order_type = Order::ORDER_TYPE[mb_strtoupper($this->order)];
            switch ($order_type) {
                case Order::ORDER_TYPE['DELIVERY']:
                    $rules['address'] = 'required|string';
                    $rules['pay_type'] = 'required|in:' . Order::PAY_TYPE['CARD'] . ',' . Order::PAY_TYPE['CASH'];
                    break;
            }
        } else {
            $rules['order'] = 'required|numeric';
        }

        return $rules;
    }
}
