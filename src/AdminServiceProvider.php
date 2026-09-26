<?php

namespace JeffersonGoncalves\Admin;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AdminServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-admin')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations();
    }
}
