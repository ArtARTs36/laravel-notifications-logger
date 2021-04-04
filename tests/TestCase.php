<?php

namespace ArtARTs36\LaravelNotificationsLogger\Tests;

use ArtARTs36\LaravelNotificationsLogger\Providers\NotificationsLoggerProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testing']);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadLaravelMigrations(['--database' => 'testing']);

        $this->withFactories(__DIR__.'/../database/factories');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
        $app['config']->set('app.debug', true);
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [NotificationsLoggerProvider::class];
    }
}
