<?php


namespace App\Abstracts;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class RepositoryAbstract
{

    public function index(): Collection
    {
        return $this->model->orderBy('id', 'ASC')->with('translations')->get();
    }

    public function store(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, Model $model): Model
    {
        $model->update($attributes);
        return $model;
    }

    public function fields(): array
    {
        return $this->model::fields();
    }

    public function delete(Model $model)
    {
        $model->delete();
    }
}
