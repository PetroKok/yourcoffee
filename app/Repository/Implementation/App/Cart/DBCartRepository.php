<?php

namespace App\Repository\Implementation\App\Cart;

use App\DTO\CartDto;
use App\Models\Cart;
use App\Models\Product;
use App\Repository\Interfaces\IDBCart;

class DBCartRepository implements IDBCart
{
    public $model;
    public $product;

    public function __construct(Cart $model, Product $product)
    {
        $this->model = $model;
        $this->product = $product;
    }

    public function index(CartDto $cartDto)
    {
        return $this->model->where('customer_id', $cartDto->getUserId())->with(['product' => function ($q) {
            return $q->with('translation');
        }])->get();
    }

    public function count(CartDto $cartDto)
    {
        return $this->model->where('customer_id', $cartDto->getUserId())->count();
    }

    public function store(CartDto $cartDto)
    {
        $product = $this->product->find($cartDto->getProductId());

        if ($product) {

            $model = $this->model->updateOrCreate(
                ['customer_id' => $cartDto->getUserId(), 'product_id' => $cartDto->getProductId()],
                ['price' => $product->price]
            )->first();

            $model->setQty($cartDto->getQty());
        }
        return $this->index($cartDto);
    }

    public function delete(CartDto $cartDto)
    {
        $product = $this->product->find($cartDto->getProductId());

        if ($product) {

            $model = $this->model->where(
                ['customer_id' => $cartDto->getUserId(), 'product_id' => $cartDto->getProductId()],
            )->first();

            $model->delete();
        }
        return $this->index($cartDto);
    }
}
