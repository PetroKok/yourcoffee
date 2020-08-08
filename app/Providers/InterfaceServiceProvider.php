<?php

namespace App\Providers;

use App\Repository\Implementation\Admin\CityRepository;
use App\Repository\Implementation\Admin\KitchenRepository;
use App\Repository\Implementation\App\Cart\CacheCartRepository;
use App\Repository\Implementation\App\Cart\DBCartRepository;
use App\Repository\Implementation\CategoryRepository;
use App\Repository\Implementation\IngredientRepository;
use App\Repository\Implementation\LabelRepository;
use App\Repository\Implementation\ProductRepository;
use App\Repository\Interfaces\CategoryRepositoryInterface;
use App\Repository\Interfaces\CityRepositoryInterface;
use App\Repository\Interfaces\ICacheCart;
use App\Repository\Interfaces\IDBCart;
use App\Repository\Interfaces\IngredientRepositoryInterface;
use App\Repository\Interfaces\KitchenRepositoryInterface;
use App\Repository\Interfaces\LabelRepositoryInterface;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\Service\Implementation\Admin\CityService;
use App\Service\Implementation\Admin\KitchenService;
use App\Service\Implementation\App\Cart\CartService;
use App\Service\Implementation\App\Cart\DeliveryService;
use App\Service\Implementation\App\City\CityGetService;
use App\Service\Implementation\App\Order\OrderService;
use App\Service\Implementation\App\User\UserService;
use App\Service\Implementation\CategoryService;
use App\Service\Implementation\FileService;
use App\Service\Implementation\IngredientService;
use App\Service\Implementation\LabelService;
use App\Service\Implementation\ProductService;
use App\Service\Interfaces\CartServiceInterface;
use App\Service\Interfaces\CategoryServiceInterface;
use App\Service\Interfaces\CityGetServiceInterface;
use App\Service\Interfaces\CityServiceInterface;
use App\Service\Interfaces\DeliveryServiceInterface;
use App\Service\Interfaces\FileServiceInterface;
use App\Service\Interfaces\IngredientServiceInterface;
use App\Service\Interfaces\KitchenServiceInterface;
use App\Service\Interfaces\LabelServiceInterface;
use App\Service\Interfaces\OrderServiceInterface;
use App\Service\Interfaces\ProductServiceInterface;
use App\Service\Interfaces\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{

    public $bindings = [
        CartServiceInterface::class => CartService::class,
        IDBCart::class => DBCartRepository::class,
        ICacheCart::class => CacheCartRepository::class,

        CategoryServiceInterface::class => CategoryService::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,

        FileServiceInterface::class => FileService::class,

        IngredientRepositoryInterface::class => IngredientRepository::class,
        IngredientServiceInterface::class => IngredientService::class,

        ProductServiceInterface::class => ProductService::class,
        ProductRepositoryInterface::class => ProductRepository::class,

        LabelServiceInterface::class => LabelService::class,
        LabelRepositoryInterface::class => LabelRepository::class,

        CityServiceInterface::class => CityService::class,
        CityRepositoryInterface::class => CityRepository::class,

        KitchenServiceInterface::class => KitchenService::class,
        KitchenRepositoryInterface::class => KitchenRepository::class,

        DeliveryServiceInterface::class => DeliveryService::class,

        OrderServiceInterface::class => OrderService::class,

        UserServiceInterface::class => UserService::class,

        CityGetServiceInterface::class => CityGetService::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
