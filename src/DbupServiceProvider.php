<?php

namespace Programic\Dbup;

use Illuminate\Support\ServiceProvider;
use Programic\Dbup\Commands\DbupCheck;

class DbupServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Registering package commands.
        if ($this->app->runningInConsole()) {
            $this->commands([
                DbupCheck::class
            ]);
        }
    }
}
