<?php

declare(strict_types=1);

namespace Sso\SooSdk\Providers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class SsoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Auth::provider('sso_users', function ($app) {
            return new SsoUserProvider(
                $app->make(Session::class)
            );
        });
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
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }
}
