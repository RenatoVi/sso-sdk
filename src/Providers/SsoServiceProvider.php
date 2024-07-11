<?php

declare(strict_types=1);

namespace Sso\SsoSdk\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SsoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Auth::provider('sso_users', function ($app) {
            return new SsoUserProvider();
        });

        $this->mergeConfigFrom(
            __DIR__.'/../../config/sso.php',
            'sso'
        );

        $this->publishes([
            __DIR__.'/../../config/sso.php' => config_path('sso.php'),
        ], 'config');

        $this->registerRoutes();
    }

    protected function registerResponseBindings(): void
    {
    }

    protected function registerRoutes(): void
    {
        Route::group([
            'as' => 'sso.',
            'prefix' => config('sso.path', 'sso'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        });
    }
}
