<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use JeffersonGoncalves\Admin\Models\Admin;
use JeffersonGoncalves\Admin\Observers\AdminObserver;
use JeffersonGoncalves\Admin\Tests\Fixtures\Admin as AppAdmin;

it('registers the admin guard, provider and password broker', function () {
    expect(config('auth.guards.admin'))->toBe(['driver' => 'session', 'provider' => 'admins'])
        ->and(config('auth.providers.admins.model'))->toBe(Admin::class)
        ->and(config('auth.passwords.admins.provider'))->toBe('admins');
});

it('authenticates an admin through the admin guard', function () {
    Admin::factory()->create(['email' => 'root@example.com', 'password' => 'secret']);

    expect(Auth::guard('admin')->attempt(['email' => 'root@example.com', 'password' => 'secret', 'status' => true]))->toBeTrue()
        ->and(Auth::guard('admin')->user())->toBeInstanceOf(Admin::class);
});

it('refuses inactive admins when status is part of the credentials', function () {
    Admin::factory()->inactive()->create(['email' => 'off@example.com', 'password' => 'secret']);

    expect(Auth::guard('admin')->attempt(['email' => 'off@example.com', 'password' => 'secret', 'status' => true]))->toBeFalse();
});

it('creates the app subclass configured on the admins provider', function () {
    config()->set('auth.providers.admins.model', AppAdmin::class);

    $admin = AppAdmin::factory()->create(['password' => 'secret']);

    expect($admin)->toBeInstanceOf(AppAdmin::class)
        ->and($admin->getTable())->toBe('admins')
        ->and(Hash::check('secret', $admin->password))->toBeTrue();
});

it('clears the admins count cache on create and delete', function () {
    Cache::forever(AdminObserver::CACHE_KEY, 99);
    $admin = Admin::factory()->create();
    expect(Cache::has(AdminObserver::CACHE_KEY))->toBeFalse();

    Cache::forever(AdminObserver::CACHE_KEY, 99);
    $admin->delete();
    expect(Cache::has(AdminObserver::CACHE_KEY))->toBeFalse();
});
