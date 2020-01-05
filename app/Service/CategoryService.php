<?php

namespace App\Service;

use App\Repository\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface
{

    public $category;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->category = $categoryRepository;
    }


    public function index(int $per_page = 10): array
    {
        return $this->category->index($per_page);
    }
}
