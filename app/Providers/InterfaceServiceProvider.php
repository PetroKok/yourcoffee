<?php

namespace App\Providers;

use App\Models\Category;
use App\Repository\CategoryRepository;
use App\Repository\CategoryRepositoryInterface;
use App\Service\CategoryService;
use App\Service\CategoryServiceInterface;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{

    public $bindings = [
        CategoryServiceInterface::class => CategoryService::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
