<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'nickname' => fake()->name(),
            'discord_id' => fake()->numberBetween(1, 999),
            'avatar' => '',
            'discord_token' => 'discord_token',
            'discord_refresh_token' => 'discord_refresh_token',
            'password' => Hash::make('password'),
        ];
    }
}
