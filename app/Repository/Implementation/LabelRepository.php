<?php

namespace App\Repository\Implementation;

use App\Abstracts\RepositoryAbstract;
use App\Models\Category;
use App\Models\Label;
use App\Repository\Interfaces\LabelRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LabelRepository extends RepositoryAbstract implements LabelRepositoryInterface
{
    public $model;

    public function __construct(Label $model)
    {
        $this->model = $model;
    }

    public function indexPluck(array $except): \Illuminate\Support\Collection
    {
        return $this->model->all()->pluck('name', 'id');
    }
}
