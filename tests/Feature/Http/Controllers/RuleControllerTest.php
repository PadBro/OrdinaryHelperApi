<?php

use App\Models\Rule;
use App\Models\User;

test('auth user can get rules', function () {
    $rule = Rule::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('rules.index'))
        ->assertOk()
        ->assertJson(['data' => [$rule->toArray()]]);
});

test('can create rule', function () {
    $user = User::factory()->create();
    $data = [
        'number' => '1',
        'name' => 'Testing',
        'rule' => 'This has to be tested!',
    ];

    $this->actingAs($user)
        ->postJson(route('rules.store'), $data)
        ->assertCreated()
        ->assertJson($data);

    $this->assertDatabaseHas('rules', $data);
});

test('can update rule', function () {
    $user = User::factory()->create();
    $rule = Rule::factory()->create();
    $data = [
        'number' => '1',
        'name' => 'Testing',
        'rule' => 'This has to be tested!',
    ];

    $this->actingAs($user)
        ->patchJson(route('rules.update', $rule), $data)
        ->assertOk()
        ->assertJson($data);

    $this->assertDatabaseHas('rules', $data);
});

test('can delete rule', function () {
    $user = User::factory()->create();
    $rule = Rule::factory()->create();

    $this->actingAs($user)
        ->deleteJson(route('rules.destroy', $rule))
        ->assertOk();

    $this->assertDatabaseMissing('rules', $rule->toArray());
});
