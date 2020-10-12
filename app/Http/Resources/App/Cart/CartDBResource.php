<?php

namespace App\Http\Resources\App\Cart;

use App\Http\Resources\App\Product\ProductCartResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartDBResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
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
                'id' => $item['product']['product_id'],
                'name' => $item['product']['product_name'],
                'category_id' => $item['product']['menu_category_id'],
                'price' => $item['price'],
                'image' => $item['product']['photo'],
            ]
        ];
    }
}
