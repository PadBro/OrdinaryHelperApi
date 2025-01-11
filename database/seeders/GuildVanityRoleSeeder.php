<?php

namespace Database\Seeders;

use App\Models\VanityRoleSeeder;
use Illuminate\Database\Seeder;

class VanityRoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        VanityRoleSeeder::factory(50)->create();
    }
}
