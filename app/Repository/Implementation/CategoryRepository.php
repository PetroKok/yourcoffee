<?php

namespace App\Repository\Implementation;

use App\Abstracts\RepositoryAbstract;
use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends RepositoryAbstract implements CategoryRepositoryInterface
{
    public $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function indexPluck(array $except): \Illuminate\Support\Collection
    {
        return $this->model->all()->except($except)->pluck('title', 'id');
    }
}
