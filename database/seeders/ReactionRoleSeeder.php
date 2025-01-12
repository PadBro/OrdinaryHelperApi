<?php

namespace Database\Seeders;

use App\Models\ReactionRole;
use Illuminate\Database\Seeder;

class ReactionRoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ReactionRole::factory(50)->create();
    }
}
