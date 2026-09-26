<?php

namespace JeffersonGoncalves\Admin\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use JeffersonGoncalves\Admin\Models\Admin;

/**
 * @extends Factory<Admin>
 */
class AdminFactory extends Factory
{
    protected static ?string $password;

    /**
     * The app's own model (e.g. App\Models\Admin extends this package's Admin),
     * so factories built through the base class still create the subclass.
     */
    public function modelName(): string
    {
        return config('auth.providers.admins.model') ?: Admin::class;
    }

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => true,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => false,
        ]);
    }
}
