<?php

namespace JeffersonGoncalves\Admin;

use JeffersonGoncalves\Admin\Models\Admin;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AdminServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-admin')
            ->hasMigration('create_admins_table');
    }

    /**
     * Registers the `admin` guard, `admins` provider and `admins` password broker,
     * unless the app's config/auth.php already defines them (app config wins).
     */
    public function packageRegistered(): void
    {
        $config = $this->app['config'];

        $defaults = [
            'auth.guards.admin' => [
                'driver' => 'session',
                'provider' => 'admins',
            ],
            'auth.providers.admins' => [
                'driver' => 'eloquent',
                'model' => Admin::class,
            ],
            'auth.passwords.admins' => [
                'provider' => 'admins',
                'table' => $config->get('auth.passwords.users.table', 'password_reset_tokens'),
                'expire' => 60,
                'throttle' => 60,
            ],
        ];

        foreach ($defaults as $key => $value) {
            if (! $config->has($key)) {
                $config->set($key, $value);
            }
        }
    }
}
