<?php


namespace App\Poster\Decorator\Product;

use App\Memory\Redis\IRedisStorage;
use App\Poster\Decorator\Decorator;
use App\Poster\Menu\IRProduct;
use Illuminate\Database\Eloquent\Collection;

class ProductDecorator extends Decorator implements IProductDecorator
{
    private IRedisStorage $storage;
    public IRProduct $repository;

    public function __construct(IRProduct $product, IRedisStorage $storage)
    {
        $this->repository = $product;
        $this->storage = $storage;
    }

    public function loadEntitiesInMemory()
    {
        $new = [];
        $this->es = $this->storage->get(config('cache_keys.products.key'));
        if (is_null($this->es)) {
            $this->es = $this->repository->all();
            foreach ($this->es as $e) {
                if (!in_array($e->menu_category_id, [0, 8, 15, 16, 17, 18, 19, 20, 24])) {
                    $new[$e->product_id] = $e;
                }
            }
            $this->es = collect($new);
            unset($new);
            $this->storage->set(config('cache_keys.products.key'), $this->es, config('cache_keys.products.time'));
        }
    }
}
