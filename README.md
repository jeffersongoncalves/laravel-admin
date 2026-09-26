![Laravel Admin](https://raw.githubusercontent.com/jeffersongoncalves/laravel-admin/main/art/jeffersongoncalves-laravel-admin.png)

# Laravel Admin

Separate `Admin` authenticatable model with its own `admin` guard, `admins` provider and password broker, plus migration, factory and observer.

Your app keeps its own `App\Models\Admin` and extends the package model, so admins live in their own table, fully apart from `users`.

## Installation

```bash
composer require jeffersongoncalves/laravel-admin
```

Publish and run the migration:

```bash
php artisan vendor:publish --tag="laravel-admin-migrations"
php artisan migrate
```

## Usage

```php
namespace App\Models;

use JeffersonGoncalves\Admin\Models\Admin as BaseAdmin;

class Admin extends BaseAdmin
{
    // add traits, relations or overrides here
}
```

Point the `admins` provider to your model in `config/auth.php`:

```php
'providers' => [
    // ...
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
],
```

### Guard, provider and password broker

The service provider registers these only when `config/auth.php` does **not** define them already (your config always wins):

| Key | Default |
|-----|---------|
| `auth.guards.admin` | `session` driver, `admins` provider |
| `auth.providers.admins` | `eloquent`, `JeffersonGoncalves\Admin\Models\Admin` |
| `auth.passwords.admins` | `admins` provider, same token table as `users`, 60 min expiry/throttle |

```php
Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'status' => true]);
```

### What the base model gives you

| Feature | Details |
|---------|---------|
| Columns | `status`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `avatar_url`, `custom_fields`, `locale`, `theme_color` |
| Casts | `password` hashed, `status` boolean, `custom_fields` array, `email_verified_at` datetime |
| Factory | `Admin::factory()` with `unverified()` and `inactive()` states. It creates the model set in `auth.providers.admins.model` |
| Observer | Clears the `admins_count` cache key on create/delete (inherited by subclasses) |

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
