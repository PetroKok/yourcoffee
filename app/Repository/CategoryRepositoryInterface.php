<?php

namespace App\Repository;

interface CategoryRepositoryInterface
{
    public function index(int $per_page = 10): array;
}
