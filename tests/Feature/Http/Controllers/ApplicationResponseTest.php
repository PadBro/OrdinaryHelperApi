<?php

use App\Enums\ApplicationResponseType;
use App\Models\ApplicationResponse;
use App\Models\User;

test('auth user can get application response', function () {
    $application = ApplicationResponse::factory()->create();
    $user = User::factory()->owner()->create();

    $this->actingAs($user)
        ->get(route('application-response.index'))
        ->assertOk()
        ->assertJson(['data' => [$application->toArray()]]);
});

test('can create application response', function () {
    $user = User::factory()->owner()->create();
    $data = [
        'type' => ApplicationResponseType::Accepted->value,
        'name' => 'Test',
        'response' => 'Test',
    ];

    $this->actingAs($user)
        ->postJson(route('application-response.store'), $data)
        ->assertCreated()
        ->assertJson(['data' => $data]);

    $this->assertDatabaseHas('application_responses', $data);
});

test('can update application response', function () {
    $user = User::factory()->owner()->create();
    $application = ApplicationResponse::factory()->create();
    $data = [
        'type' => ApplicationResponseType::Accepted->value,
        'name' => 'Test',
        'response' => 'Test',
    ];

    $this->actingAs($user)
        ->patchJson(route('application-response.update', $application), $data)
        ->assertOk()
        ->assertJson(['data' => $data]);

    $this->assertDatabaseHas('application_responses', $data);
});

test('can delete application response', function () {
    $user = User::factory()->owner()->create();
    $application = ApplicationResponse::factory()->create();

    $this->actingAs($user)
        ->deleteJson(route('application-response.destroy', $application))
        ->assertOk();

    $this->assertDatabaseMissing('application_responses', $application->toArray());
});
