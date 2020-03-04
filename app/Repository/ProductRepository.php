<?php

namespace App\Repository;

use App\Abstracts\RepositoryAbstract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends RepositoryAbstract implements ProductRepositoryInterface
{
    public $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function index(): Collection
    {
        return $this->model->orderBy('id', 'ASC')->with(['translations', 'category'])->get();
    }

    public function indexPluck(array $except): \Illuminate\Support\Collection
    {
        // TODO: Implement indexPluck() method.
    }
}
