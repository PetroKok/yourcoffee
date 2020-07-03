<?php

namespace App\Service\Implementation\Admin;

use App\Repository\Interfaces\CityRepositoryInterface;
use App\Service\Interfaces\CityServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CityService implements CityServiceInterface
{
    public $city;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->city = $cityRepository;
    }

    public function index(): Collection
    {
        return $this->city->index();
    }

    public function store(array $attributes): Model
    {
        return $this->city->store($attributes);
    }

    public function update(array $attributes, Model $model): Model
    {
        return $this->city->update($attributes, $model);
    }

    public function fields(): array
    {
        return $this->city->fields();
    }

    public function indexPluck(array $except = []): \Illuminate\Support\Collection
    {
        return $this->city->indexPluck($except);
    }
}
