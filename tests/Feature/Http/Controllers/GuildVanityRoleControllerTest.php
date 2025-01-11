<?php

use App\Models\User;
use App\Models\VanityRole;
use Illuminate\Support\Facades\Http;

test('auth user can get vanity roles', function () {
    $vanityRole = VanityRole::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('vanity-role.index'))
        ->assertOk()
        ->assertJson(['data' => [$vanityRole->toArray()]]);
});

test('can create vanity role', function () {
    Http::fake([
        config('services.discord.api_url').'/guilds/*' => Http::response([]),
    ]);
    $user = User::factory()->create();
    $data = [
        'role_id' => '112233445566778899',
        'vanity_url_code' => 'Abc123DEF345',
    ];

    $this->actingAs($user)
        ->postJson(route('vanity-role.store'), $data)
        ->assertCreated()
        ->assertJson($data);

    $this->assertDatabaseHas('vanity_roles', $data);
});

test('can update vanity role', function () {
    Http::fake([
        config('services.discord.api_url').'/guilds/*' => Http::response([]),
    ]);
    $user = User::factory()->create();
    $vanityRole = VanityRole::factory()->create();
    $data = [
        'role_id' => '112233445566778899',
        'vanity_url_code' => 'Abc123DEF345',
    ];

    $this->actingAs($user)
        ->patchJson(route('vanity-role.update', $vanityRole), $data)
        ->assertOk()
        ->assertJson($data);

    $this->assertDatabaseHas('vanity_roles', $data);
});

test('can delete vanity role', function () {
    $user = User::factory()->create();
    $vanityRole = VanityRole::factory()->create();

    $this->actingAs($user)
        ->deleteJson(route('vanity-role.destroy', $vanityRole))
        ->assertOk();

    $this->assertDatabaseMissing('vanity_roles', $vanityRole->toArray());
});
