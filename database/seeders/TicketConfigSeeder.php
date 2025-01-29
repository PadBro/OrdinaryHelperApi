<?php

namespace Database\Seeders;

use App\Models\TicketConfig;
use Illuminate\Database\Seeder;

class TicketConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketConfig::factory()->create(['guild_id' => config('services.discord.server_id')]);
    }
}
