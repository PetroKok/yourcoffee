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
            'title' => $this['title'] ?? null,
            'city' => $this['city'] ?? null,
            'address' => $this['address'] ?? null,
            'is_open' => $this['is_open'] ?? false,
            'specify' => trans('app.cart.specify'),
            'email' => $this['email'] ?? null,
            'phone' => $this['phone'] ?? null,
            'price_delivery' => $this['price_delivery'] ?? 0,
            'time_delivery' => $this['time_delivery'] ?? 0,
        ];
    }
}
