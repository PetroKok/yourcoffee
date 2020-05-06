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
        $cart = $this->model->where('customer_id', $cartDto->getUserId())->get()->toArray();
        return array_sum(array_column($cart, 'qty'));
    }

    public function store(CartDto $cartDto)
    {
        $product = $this->product->find($cartDto->getProductId());

        if ($product) {
            $model = $this->model->updateOrCreate(
                ['customer_id' => $cartDto->getUserId(), 'product_id' => $cartDto->getProductId()],
                ['price' => $product->price]
            )->first();

            if($cartDto->getQty() === 0){
                $model->delete();
            }else{
                if($cartDto->isReplace()){
                    $model->setQty($cartDto->getQty());
                }else{
                    $model->qty = $cartDto->getQty();
                }
            }
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
