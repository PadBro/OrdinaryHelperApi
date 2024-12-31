<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ServerContentSeeder::class,
            ApplicationSeeder::class,
            FaqSeeder::class,
            RuleSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
        ]);
    }
}
