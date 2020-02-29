<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface
{
    public function index(): Collection;

    public function fields(): array;

    public function store(array $attributes): Model;

    public function indexPluck(array $except): \Illuminate\Support\Collection;
}
