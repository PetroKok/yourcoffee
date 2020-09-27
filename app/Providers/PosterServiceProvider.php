<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PosterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $poster = config('poster');
        $poster = collect($poster);

        foreach ($poster->get('classes') as $class) {
            $this->app->bind($class['i'], function () use ($class, $poster) {
                return new $class['c']($poster->get('api'));
            });
        }
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
