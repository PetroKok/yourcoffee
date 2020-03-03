<?php

namespace App\Providers;

use App\Models\Category;
use App\Repository\CategoryRepository;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\IngredientRepository;
use App\Repository\IngredientRepositoryInterface;
use App\Service\CategoryService;
use App\Service\CategoryServiceInterface;
use App\Service\FileService;
use App\Service\FileServiceInterface;
use App\Service\IngredientService;
use App\Service\IngredientServiceInterface;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{

    public $bindings = [
        CategoryServiceInterface::class => CategoryService::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        FileServiceInterface::class => FileService::class,
        IngredientRepositoryInterface::class => IngredientRepository::class,
        IngredientServiceInterface::class => IngredientService::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryServiceInterface::class, function(){
            return new CategoryService();
        });

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
