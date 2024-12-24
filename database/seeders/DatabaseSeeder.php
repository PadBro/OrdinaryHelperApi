<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ApplicationQuestion;
use App\Models\ApplicationQuestionAnswer;
use App\Models\ApplicationResponse;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Application::factory(10)->create();
        ApplicationQuestion::factory(10)->create();
        ApplicationQuestionAnswer::factory(10)->create();
        ApplicationResponse::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
        ]);
    }
}
