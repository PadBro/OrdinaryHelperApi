<?php

use App\Models\User;

test('can login', function () {
    $user = User::factory()->owner()->create();

    $this->postJson(route('login'), [
        'name' => $user->name,
        'password' => 'password',
    ])
        ->assertOk();
});

test('can not login', function () {
    $user = User::factory()->owner()->create();
    $this->postJson(route('login'), [
        'name' => $user->name,
        'password' => '123',
    ])
        ->assertUnprocessable();
});

test('can logout', function () {
    $user = User::factory()->owner()->create();
    $this->actingAs($user)
        ->postJson(route('logout'))
        ->assertOk();
});
