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
            ReactionRoleSeeder::class,
            TicketConfigSeeder::class,
            TicketPanelSeeder::class,
            TicketSeeder::class,
            TicketTeamSeeder::class,
            TicketTranscriptSeeder::class,
            TicketButtonSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
        ]);
    }
}
