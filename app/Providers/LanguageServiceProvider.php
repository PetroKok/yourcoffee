<?php

namespace App\Providers;

use App\Models\Locale;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
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
        config(['translatable.locales' => Locale::orderBy('locale', 'desc')->get()->pluck('locale')->toArray() ?? []]);
        View::share('locales', config('translatable.locales'));
    }
}
