<?php

namespace ArtARTs36\LaravelNotificationsLogger\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteProvider extends RouteServiceProvider
{
    protected $namespace = '\ArtARTs36\LaravelNotificationsLogger\Http\Controllers';

    public function map()
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix(config('notifications_logger.routes.api.prefix', ''))
            ->middleware(config('notifications_logger.routes.api.middleware', []))
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../../routes/api.php');
    }
}
