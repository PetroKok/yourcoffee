<?php

namespace App\Repository\Implementation\Admin;

use App\Abstracts\RepositoryAbstract;
use App\Models\Category;
use App\Models\City;
use App\Repository\Interfaces\CategoryRepositoryInterface;
use App\Repository\Interfaces\CityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CityRepository extends RepositoryAbstract implements CityRepositoryInterface
{
    public $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function indexPluck(array $except): \Illuminate\Support\Collection
    {
        return $this->model->with('translations')->get()->except($except)->pluck('name', 'id');
    }
}
