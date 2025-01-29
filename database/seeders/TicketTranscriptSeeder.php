<?php

namespace Database\Seeders;

use App\Models\TicketTranscript;
use Illuminate\Database\Seeder;

class TicketTranscriptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketTranscript::factory(2)->create();
    }
}
