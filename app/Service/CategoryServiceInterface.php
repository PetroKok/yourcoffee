<?php

namespace App\Service;

interface CategoryServiceInterface
{
    public function index(int $per_page = 10): array;
}
