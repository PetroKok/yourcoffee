<?php


namespace App\Poster\Decorator\Product;


interface IProductDecorator
{
    public function find($ids);

    public function loadProductsInMemory();
}
