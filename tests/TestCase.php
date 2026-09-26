<?php

namespace JeffersonGoncalves\Admin\Tests;

use JeffersonGoncalves\Admin\AdminServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            AdminServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
    }

    protected function defineDatabaseMigrations(): void
    {
        (include __DIR__.'/../database/migrations/create_admins_table.php.stub')->up();
    }
}
