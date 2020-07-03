<?php

namespace App\Http\Resources\App\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [];
        $items = parent::toArray($request);
        foreach ($items as $item) {
            $response[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'category_id' => $item['category_id'],
                'price' => $item['price'],
                'image' => $item['image'],
            ];
        }
        return $response;
    }
}
