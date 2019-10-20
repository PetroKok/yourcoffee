<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {

        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->domain(env('APP_ROUTE'))
             ->namespace('App\Http\Controllers\App')
             ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->domain(env('APP_ROUTE'))
             ->namespace('App\Http\Controllers\Api')
             ->group(base_path('routes/api.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware(['web', 'admin'])
            ->prefix('admin')
            ->as('admin::')
            ->domain(/*'admin.'.*/env("APP_ROUTE"))
            ->namespace('App\Http\Controllers\Admin')
            ->group(base_path('routes/admin.php'));
    }
}
