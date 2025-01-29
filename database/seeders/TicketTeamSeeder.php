<?php

namespace Database\Seeders;

use App\Models\TicketTeam;
use Illuminate\Database\Seeder;

class TicketTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketTeam::factory(2)->create();
    }
}
