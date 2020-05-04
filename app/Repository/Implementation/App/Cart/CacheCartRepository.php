<?php


namespace App\Repository\Implementation\App\Cart;


use App\DTO\CartDto;
use App\Models\Product;
use App\Repository\Interfaces\ICacheCart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

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
        return 100;
    }

    public function store(CartDto $cartDto)
    {
        $ses = request()->session();

        $carts = $ses->get('cart');

        $product = Product::find($cartDto->getProductId());

        $carts[$product->id] = [
            'product_id' => $product->id,
            'price' => $product->price,
            'qty' => $cartDto->getQty(),
            'created_at' => Carbon::now()->format('y-m-d H:m:i'),
        ];

        $ses->put('cart', $carts);

        $ses->save();

        return $this->index($cartDto);

        return $carts;
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
        dd($carts);
    }
}
