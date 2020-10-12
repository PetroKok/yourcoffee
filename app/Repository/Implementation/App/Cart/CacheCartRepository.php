<?php

namespace App\Repository\Implementation\App\Cart;

use App\DTO\CartDto;
use App\Models\Product;
use App\Poster\Decorator\Product\IProductDecorator;
use App\Poster\Menu\IRProduct;
use App\Repository\Interfaces\ICacheCart;
use Carbon\Carbon;

class CacheCartRepository implements ICacheCart
{
    public IProductDecorator $product;

    public function __construct(IProductDecorator $product)
    {
        $this->product = $product;
    }

    public function index(CartDto $cartDto)
    {
        $carts = request()->session()->get(config('session.keys.cart'));
        return $carts ? $this->mapCache($carts) : [];
    }

    public function count(CartDto $cartDto)
    {
        $ses = request()->session()->get(config('session.keys.cart'));
        if ($ses) {
            $qty = array_column($ses, 'qty');
            $prices = array_column($ses, 'price');

            $full_amount = 0;
            foreach ($qty as $key => $q) {
                $full_amount += ($qty[$key] * $prices[$key]) / 100;
            }

            if ($ses) {
                return [array_sum(array_column($ses, 'qty')), price_format($full_amount)];
            }
        }
        return [0, 0];
    }

    public function store(CartDto $cartDto)
    {
        $ses = request()->session();

        $carts = $ses->get(config('session.keys.cart'));

        $product = $this->product->find($cartDto->getProductId());

        if ($cartDto->getQty() === 0) {
            unset($carts[$cartDto->getProductId()]);
        } else {

            /** TODO: SET price based on the "spot" location **/
            $price = collect($product->get('price'))->get('1');
            if ($cartDto->isReplace()) {

                $carts[$cartDto->getProductId()] = [
                    'product_id' => $cartDto->getProductId(),
                    'price' => $price,
                    'qty' => $cartDto->getQty(),
                    'created_at' => Carbon::now()->format('y-m-d H:m:i'),
                ];
            } else {
                if (isset($carts[$cartDto->getProductId()]) && $carts[$cartDto->getProductId()]['qty'] !== null) {
                    $carts[$cartDto->getProductId()]['qty'] += $cartDto->getQty();
                    if ($carts[$cartDto->getProductId()]['qty'] === 0) {
                        unset($carts[$cartDto->getProductId()]);
                    }
                } else {
                    $carts[$cartDto->getProductId()] = [
                        'product_id' => $cartDto->getProductId(),
                        'price' => $price,
                        'qty' => $cartDto->getQty(),
                        'created_at' => Carbon::now()->format('y-m-d H:m:i'),
                    ];
                }
            }
        }

        $ses->put(config('session.keys.cart'), $carts);

        $ses->save();

        if (isset($carts[$cartDto->getProductId()])) {
            return $this->mapCache([$carts[$cartDto->getProductId()]])[0];
        }

        return [];
    }

    public function delete(CartDto $cartDto)
    {
        // TODO: Implement delete() method.
    }

    public function mapCache(array $carts)
    {
        foreach ($carts as $key => $cart) {
            $product = $this->product->find($cart['product_id']);
            if ($product !== false) {
                $carts[$key]['price'] = (float)$carts[$key]['price'] / 100;
                $carts[$key]['amount'] = (int)$carts[$key]['qty'] * (float)$carts[$key]['price'];
                $carts[$key]['product'] = $product;
            }
        }
        return $carts;
    }

    public function rawCart(CartDto $cartDto)
    {
        return request()->session()->get(config('session.keys.cart'));
    }

    public function clearCart(CartDto $cartDto)
    {
        $ses = request()->session();
        $ses->put(config('session.keys.cart'), []);
    }
}
