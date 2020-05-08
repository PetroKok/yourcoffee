<?php


namespace App\Repository\Implementation\App\Cart;


use App\DTO\CartDto;
use App\Models\Product;
use App\Repository\Interfaces\ICacheCart;
use Carbon\Carbon;

class CacheCartRepository implements ICacheCart
{

    public function index(CartDto $cartDto)
    {
        $carts = request()->session()->get('cart');
        $carts = $this->mapCache($carts);
        return $carts;
    }

    public function count(CartDto $cartDto)
    {
        $ses = request()->session()->get(config('session.keys.cart'));

        if ($ses) {
            return array_sum(array_column($ses, 'qty'));
        }
        return 0;
    }

    public function store(CartDto $cartDto)
    {
        $ses = request()->session();

        $carts = $ses->get(config('session.keys.cart'));

        $product = Product::find($cartDto->getProductId());

        if ($cartDto->getQty() === 0) {
            unset($carts[$product->id]);
        } else {
            if ($cartDto->isReplace()) {
                $carts[$product->id] = [
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'qty' => $cartDto->getQty(),
                    'created_at' => Carbon::now()->format('y-m-d H:m:i'),
                ];
            } else {
                if (isset($carts[$product->id]) && $carts[$product->id]['qty'] !== null) {
                    $carts[$product->id]['qty'] += $cartDto->getQty();
                }
            }
        }

        $ses->put(config('session.keys.cart'), $carts);

        $ses->save();

        return $this->index($cartDto);
    }

    public function delete(CartDto $cartDto)
    {
        // TODO: Implement delete() method.
    }

    public function mapCache(array $carts)
    {
        $product_ids = array_column($carts, 'product_id');
        $products = Product::find($product_ids);

        $products = $products->toArray();

        foreach ($carts as $key => $cart) {
            $pos = array_search($key, array_column($products, 'id'));
            if ($pos !== false) {
                $carts[$key]['product'] = $products[$pos];
            }
        }
        return $carts;
    }
}
