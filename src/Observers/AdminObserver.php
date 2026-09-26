<?php

namespace JeffersonGoncalves\Admin\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AdminObserver
{
    public const CACHE_KEY = 'admins_count';

    public function created(Model $admin): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public function deleted(Model $admin): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
