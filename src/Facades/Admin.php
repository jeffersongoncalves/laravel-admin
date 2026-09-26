<?php

namespace JeffersonGoncalves\Admin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JeffersonGoncalves\Admin\Admin
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-admin';
    }
}
