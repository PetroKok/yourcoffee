<?php

namespace App\Service\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CityServiceInterface
{
    public function index(): Collection;

    public function indexPluck(array $except = []): \Illuminate\Support\Collection;

    public function fields(): array;

    public function store(array $attributes): Model;

    public function update(array $attributes, Model $model): Model;
}
