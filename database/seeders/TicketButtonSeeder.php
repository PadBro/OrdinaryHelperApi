<?php

namespace Database\Seeders;

use App\Models\TicketButton;
use Illuminate\Database\Seeder;

class TicketButtonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketButton::factory(2)->create();
    }
}
