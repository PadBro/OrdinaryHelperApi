<?php

namespace Database\Seeders;

use App\Models\ServerContent;
use Illuminate\Database\Seeder;

class ServerContentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ServerContent::factory(50)->create();
    }
}
