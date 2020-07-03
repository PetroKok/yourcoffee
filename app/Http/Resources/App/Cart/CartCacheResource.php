<?php

namespace App\Http\Resources\App\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartCacheResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $item = parent::toArray($request);

        if (!count($item)) {
            return [];
        }

        return [
            'product_id' => $item['product_id'],
            'price' => $item['price'],
            'qty' => $item['qty'],
            'amount' => $item['amount'],
            'product' => [
                'id' => $item['product']['id'],
                'name' => $item['product']['name'],
                'category_id' => $item['product']['category_id'],
                'price' => $item['product']['price'],
                'image' => $item['product']['image'],
            ]
        ];
    }
}
