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
        return [
            'product_id' => $this->product_id,
            'price' => $this->price,
            'qty' => $this->qty,
            'amount' => $this->amount,
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'category_id' => $this->product->category_id,
                'price' => $this->product->price,
                'image' => $this->product->image,
            ]
        ];
    }
}
