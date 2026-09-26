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
}
