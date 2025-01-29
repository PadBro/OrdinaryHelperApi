<?php

namespace Database\Seeders;

use App\Models\TicketPanel;
use Illuminate\Database\Seeder;

class TicketPanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketPanel::factory(2)->create();
    }
}
