<?php

namespace App\Poster\Menu;

use App\Poster\Poster;
use Illuminate\Support\Collection;

class RProduct extends Poster implements IRProduct
{
    public int $product_id;

    public function all()
    {
        $routeTree = ['menu', 'getProducts'];

        $this->setRoute($routeTree);

        $res = $this->request();

        $res = collect(json_decode($res->getBody()->getContents())->response);

        return $res;
    }

    public function find(int $product_id)
    {
        $routeTree = ['menu', 'getProduct'];

        $this->setRoute($routeTree);

        $this->setProductId($product_id);

        $res = $this->request();

        $res = collect(json_decode($res->getBody()->getContents())->response);

        return $res;
    }


    public function setProductId(int $id)
    {
        $this->product_id = $id;
        $this->setOnUrl($this->product_id, 'product_id');
    }

    public function groupByCategory(Collection $products, Collection $categories)
    {
        foreach ($categories as $c) {
            $categories[$c->category_id] = $c;
        }
        $a = [];
        foreach ($products as $item) {
            if ($item->menu_category_id == 0) {
                continue;
            }
            $a[$categories[$item->menu_category_id]->sort_order][$item->product_id] = $item;
        }
        ksort($a);
        return $a;
    }
}
