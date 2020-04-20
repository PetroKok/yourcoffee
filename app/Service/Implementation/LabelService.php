<?php

namespace App\Service\Implementation;

use App\Repository\Interfaces\LabelRepositoryInterface;
use App\Service\Interfaces\LabelServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LabelService implements LabelServiceInterface
{
    public $label;

    public function __construct(LabelRepositoryInterface $label)
    {
        $this->label = $label;
    }

    public function index(): Collection
    {
        return $this->label->index();
    }

    public function store(array $attributes): Model
    {
        return $this->label->store($attributes);
    }

    public function update(array $attributes, Model $model): Model
    {
        return $this->label->update($attributes, $model);
    }

    public function fields(): array
    {
        return $this->label->fields();
    }

    public function indexPluck(array $except = []): \Illuminate\Support\Collection
    {
        return $this->label->indexPluck($except);
    }
}
