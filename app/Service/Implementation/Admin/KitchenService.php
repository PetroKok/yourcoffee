<?php

namespace App\Service\Implementation\Admin;

use App\Repository\Interfaces\KitchenRepositoryInterface;
use App\Service\Interfaces\KitchenServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class KitchenService implements KitchenServiceInterface
{
    public $kitchen;

    public function __construct(KitchenRepositoryInterface $kitchenRepository)
    {
        $this->kitchen = $kitchenRepository;
    }

    public function index(): Collection
    {
        return $this->kitchen->index();
    }

    public function store(array $attributes): Model
    {
        return $this->kitchen->store($attributes);
    }

    public function update(array $attributes, Model $model): Model
    {
        return $this->kitchen->update($attributes, $model);
    }

    public function fields(): array
    {
        return $this->kitchen->fields();
    }

    public function indexPluck(array $except = []): \Illuminate\Support\Collection
    {
        return $this->kitchen->indexPluck($except);
    }
}
