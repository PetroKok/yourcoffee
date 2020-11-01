<?php

namespace App\Repository\Implementation\App\Cart;

use App\DTO\CartDto;
use App\Models\Cart;
use App\Models\Product;
use App\Poster\Decorator\Product\IProductDecorator;
use App\Repository\Interfaces\CartRepositoryInterface;
use App\Repository\Interfaces\ICacheCart;
use App\Repository\Interfaces\IDBCart;

class DBCartRepository implements IDBCart
{
    public Cart $model;
    public IProductDecorator $product;
    public CacheCartRepository $cacheCart;

    public function __construct(Cart $model, IProductDecorator $product, CacheCartRepository $cacheCart)
    {
        $this->model = $model;
        $this->cacheCart = $cacheCart;
        $this->product = $product;
    }

    public function index(CartDto $cartDto)
    {
        $carts = $this->model->where('customer_id', $cartDto->getUserId())->get()->toArray();
        return $this->cacheCart->mapCache($carts);
    }

    public function count(CartDto $cartDto)
    {
        $cart = $this->model->where('customer_id', $cartDto->getUserId())->get()->toArray();

        if ($cart) {
            $qty = array_column($cart, 'qty');
            $prices = array_column($cart, 'price');

            $full_amount = 0;
            foreach ($qty as $key => $q) {
                $full_amount += $qty[$key] * ($prices[$key] / 100);
            }
            return [array_sum(array_column($cart, 'qty')), $full_amount];
        }
        return [0, 0];
    }

    public function store(CartDto $cartDto)
    {
        $product = $this->product->find($cartDto->getProductId());

        if ($product) {
            /** TODO: SET price based on the "spot" location **/
            $price = collect($product->get('price'))->get('1');

            $model_new = $this->model->updateOrCreate(
                ['customer_id' => $cartDto->getUserId(), 'product_id' => $cartDto->getProductId()],
                ['price' => $price]
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

            return $this->index($cartDto);
        }
        return null;
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

    public function clearCart(CartDto $cartDto)
    {
        return $this->model->where('customer_id', $cartDto->getUserId())->delete();
    }

    public function mapCache(array $carts)
    {
        // TODO: Implement mapCache() method.
    }
}
