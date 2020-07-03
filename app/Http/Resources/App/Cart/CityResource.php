<?php

namespace App\Http\Resources\App\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this['title'],
            'city' => $this['city'],
            'address' => $this['address'],
            'is_open' => $this['is_open'],
            'email' => $this['email'],
            'phone' => $this['phone'],
            'price_delivery' => $this['price_delivery'],
            'time_delivery' => $this['time_delivery'],
        ];
    }
}
