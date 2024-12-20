<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('can change password', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);
    $newPassword = 'Passw0rd!123@Test';
    $this->assertFalse(Hash::check($newPassword, $user->password));

    $this->actingAs($user)
        ->patchJson(route('users.update', $user), [
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ])
        ->assertOk();

    $user->refresh();
    $this->assertTrue(Hash::check($newPassword, $user->password));
});
