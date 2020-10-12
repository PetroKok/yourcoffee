<?php

namespace App\Poster\Decorator;

interface IDecorator
{
    public function all();

    public function find($ids);

    public function loadEntitiesInMemory();
}
