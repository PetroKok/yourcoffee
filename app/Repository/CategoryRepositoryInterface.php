<?php

namespace App\Repository;

interface CategoryRepositoryInterface
{
    public function index(int $per_page = 10): array;

    public function fields(): array;

    public function indexPluck(array $except): array;

    public function store(array $attributes): array;
}
