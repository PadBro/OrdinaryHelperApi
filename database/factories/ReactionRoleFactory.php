<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReactionRole>
 */
class ReactionRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message_id' => fake()->numberBetween(100000000000000000, 999999999999999999),
            'channel_id' => fake()->numberBetween(100000000000000000, 999999999999999999),
            'emoji' => '<Test:100000000000000000>',
            'role_id' => fake()->numberBetween(100000000000000000, 999999999999999999),
        ];
    }
}
