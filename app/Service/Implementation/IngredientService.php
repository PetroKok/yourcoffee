<?php


namespace App\Service\Implementation;


use App\Repository\Interfaces\IngredientRepositoryInterface;
use App\Service\Interfaces\IngredientServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class IngredientService implements IngredientServiceInterface
{
    public $repository;

    public function __construct(IngredientRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(): Collection
    {
        return $this->repository->index();
    }

    public function fields(): array
    {
        return $this->repository->fields();
    }

    public function update(array $attributes, Model $model): Model
    {
        return $this->repository->update($attributes, $model);
    }

    public function store(array $attributes): Model
    {
        return $this->repository->store($attributes);
    }

    public function indexPluck(array $except = []): \Illuminate\Support\Collection
    {
        return $this->repository->indexPluck($except);
    }

    public function delete(Model $model)
    {
        $this->repository->delete($model);
    }
}
