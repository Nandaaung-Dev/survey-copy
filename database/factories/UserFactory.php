<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => $this->faker->numerify('09#########'),
            'department_id' => Department::all()->random()->id,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('secret'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => Role::query()->first()->id,
            'department_id' => null,
        ]);
    }

    public function supervisor(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Supervisor',
            'email' => 'supervisor@gmail.com',
            'role_id' => Role::query()->first()->id,
        ]);
    }

    public function surveryor(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Surveryor',
            'email' => 'surveryor@gmail.com',
            'role_id' => Role::query()->first()->id,
        ]);
    }
}
