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
        return $this->model->where('customer_id', $cartDto->getUserId())->with('product.translation')->get();
    }

    public function count(CartDto $cartDto)
    {
        $cart = $this->model->where('customer_id', $cartDto->getUserId())->get()->toArray();

        if ($cart) {
            $qty = array_column($cart, 'qty');
            $prices = array_column($cart, 'price');

            $full_amount = 0;
            foreach ($qty as $key => $q) {
                $full_amount += $qty[$key] * $prices[$key];
            }

            return [array_sum(array_column($cart, 'qty')), $full_amount];
        }
        return 0;
    }

    public function store(CartDto $cartDto)
    {
        $product = $this->product->find($cartDto->getProductId());

        if ($product) {
            $model_new = $this->model->updateOrCreate(
                ['customer_id' => $cartDto->getUserId(), 'product_id' => $cartDto->getProductId()],
                ['price' => $product->price]
            )->where(['customer_id' => $cartDto->getUserId(), 'product_id' => $cartDto->getProductId()])->first();

            if ($cartDto->getQty() === 0) {
                $model_new->delete();
            } else {
                if ($cartDto->isReplace()) {
                    $model_new->qty = $cartDto->getQty();
                } else {
                    $model_new->setQty($cartDto->getQty());
                    if ($model_new->qty <= 0) {
                        $model_new->delete();
                    }
                }
            }
        }

        $model_new->load('product.translation');

        return $model_new;
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

    public function rawCart(CartDto $cartDto)
    {
        return $this->model->where('customer_id', $cartDto->getUserId())->get();
    }
}
