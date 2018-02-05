<?php

namespace Jevets\Menuer;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $path = __DIR__ . '/../resources/views';

        $this->loadViewsFrom($path, 'menuer');

        $this->publishes([
            $path => resource_path('views/vendor/menuer')
        ], 'menuer-views');
    }
}
