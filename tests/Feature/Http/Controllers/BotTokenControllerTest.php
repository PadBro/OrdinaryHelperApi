<?php

use App\Models\User;

test('auth user can get faqs', function () {
    $user = User::factory()->owner()->create();

    $this->assertDatabaseMissing('users', ['name' => 'Discord Bot']);

    $this->actingAs($user)
        ->get(route('bot.token'))
        ->assertOk()
        ->assertJsonStructure([
            'token',
        ]);

    $this->assertDatabaseHas('users', ['name' => 'Discord Bot']);

    $botUser = User::where(['name' => 'Discord Bot'])->first();
    $this->assertEquals(1, $botUser->tokens()->count());

    $this->actingAs($user)
        ->get(route('bot.token'))
        ->assertOk()
        ->assertJsonStructure([
            'token',
        ]);
    $this->assertEquals(1, $botUser->tokens()->count());
});
