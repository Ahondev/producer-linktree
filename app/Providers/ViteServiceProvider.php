<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class ViteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Vite::macro('image', fn (string $asset) => Vite::asset("resources/images/{$asset}"));
//        Vite::macro('svg', fn (string $asset) => Vite::asset("resources/svg/{$asset}"));
//        Vite::macro('icon', fn (string $asset) => Vite::asset("resources/svg/icon/{$asset}"));
    }
}
