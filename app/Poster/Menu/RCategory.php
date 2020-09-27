<?php

namespace App\Poster\Menu;

use App\Poster\Poster;

class RCategory extends Poster implements IRCategory
{

    public function all()
    {
        $routeTree = ['menu', 'getCategories'];

        $this->setRoute($routeTree);

        $res = $this->request();

        $res = collect(json_decode($res->getBody()->getContents())->response);

        return $res;
    }

    public function find()
    {
        // TODO: Implement find() method.
    }
}
