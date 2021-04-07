<?php

namespace ArtARTs36\LaravelNotificationsLogger\Providers;

use ArtARTs36\LaravelNotificationsLogger\Services\SystemNameSelector;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;

class NotificationsLoggerProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $configPath = __DIR__ . '/../../config/notifications_logger.php';

            $this->publishes([
                $configPath => config_path('notifications_logger.php'),
            ], 'notifications_logger');

            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->mergeConfigFrom($configPath, 'notifications_logger');
            $this->registerFactories();
        }

        $this->registerSystemNameSelector();
        $this->app->register(RouteProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    protected function registerSystemNameSelector(): void
    {
        $this->app->singleton(SystemNameSelector::class, function () {
            return new SystemNameSelector(config()->get('notifications_logger.system_mapping.subject_system', []));
        });
    }

    protected function registerFactories(): void
    {
        $this
            ->app
            ->make(EloquentFactory::class)
            ->load(__DIR__ . '/../../database/factories');
    }
}
