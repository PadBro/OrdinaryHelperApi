<?php

use App\Models\Faq;
use App\Models\User;

test('auth user can get faqs', function () {
    $faq = Faq::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('faqs.index'))
        ->assertOk()
        ->assertJson(['data' => [$faq->toArray()]]);
});

test('can create faq', function () {
    $user = User::factory()->create();
    $data = [
        'question' => 'Is this a test?',
        'answer' => 'Yes, this is a test!',
    ];

    $this->actingAs($user)
        ->postJson(route('faqs.store'), $data)
        ->assertCreated()
        ->assertJson($data);

    $this->assertDatabaseHas('faqs', $data);
});

test('can update faq', function () {
    $user = User::factory()->create();
    $faq = Faq::factory()->create();
    $data = [
        'question' => 'Is this a test?',
        'answer' => 'Yes, this is a test!',
    ];

    $this->actingAs($user)
        ->patchJson(route('faqs.update', $faq), $data)
        ->assertOk()
        ->assertJson($data);

    $this->assertDatabaseHas('faqs', $data);
});

test('can delete faq', function () {
    $user = User::factory()->create();
    $faq = Faq::factory()->create();

    $this->actingAs($user)
        ->deleteJson(route('faqs.destroy', $faq))
        ->assertOk();

    $this->assertDatabaseMissing('faqs', $faq->toArray());
});
