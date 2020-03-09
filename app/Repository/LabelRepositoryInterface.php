<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface LabelRepositoryInterface
{
    public function index(): Collection;

    public function fields(): array;

    public function update(array $attributes, Model $model): Model;

    public function store(array $attributes): Model;

    public function indexPluck(array $except): \Illuminate\Support\Collection;

    public function delete(Model $model);
}
