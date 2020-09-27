<?php

namespace App\Poster\Menu;

use Illuminate\Support\Collection;

interface IRProduct
{
    public function all();

    public function find(int $product_id);

    public function setProductId(int $id);

    public function groupByCategory(Collection $products, Collection $categories);
}
