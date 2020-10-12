<?php

namespace App\Poster\Decorator\Category;

use App\Memory\Redis\IRedisStorage;
use App\Poster\Decorator\Decorator;
use App\Poster\Menu\IRCategory;

class CategoryDecorator extends Decorator implements ICategoryDecorator
{
    /**
     * @var IRedisStorage
     */
    public IRedisStorage $storage;
    /**
     * @var IRCategory
     */
    private IRCategory $repository;

    public function __construct(IRCategory $repository, IRedisStorage $storage)
    {
        $this->repository = $repository;
        $this->storage = $storage;
    }

    public function loadEntitiesInMemory()
    {
        $this->es = $this->storage->get(config('cache_keys.categories.key'));
        if (is_null($this->es)) {
            $this->es = $this->repository->all();
            foreach ($this->es as $key => $e) {
                $this->es[$e->category_id] = $e;
            }
            $this->storage->set(config('cache_keys.categories.key'), $this->es, config('cache_keys.categories.time'));
        }
    }
}
