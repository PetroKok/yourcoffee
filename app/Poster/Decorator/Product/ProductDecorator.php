<?php


namespace App\Poster\Decorator\Product;

use App\Memory\Redis\IRedisStorage;
use App\Poster\Menu\IRProduct;
use Illuminate\Database\Eloquent\Collection;

class ProductDecorator implements IProductDecorator
{
    private IRProduct $product;
    private IRedisStorage $storage;
    private $products = [];

    public function __construct(IRProduct $product, IRedisStorage $storage)
    {
        $this->product = $product;
        $this->storage = $storage;
    }

    public function all()
    {
        $this->loadProductsInMemory();
        return $this->products;
    }

    public function find($ids)
    {
        $this->loadProductsInMemory();
    }

    public function loadProductsInMemory()
    {
        $this->products = $this->storage->get(config('cache_keys.products.key'));
        if (is_null($this->products)) {
            $this->products = $this->product->all();
//            foreach ($poster_products as $key => $product) {
//                $this->products[$product->product_id] = $product;
//            }
            $this->products = Collection::make($this->products);
            unset($poster_products);
        }
    }
}
