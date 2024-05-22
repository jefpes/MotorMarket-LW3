<?php

use App\Models\User;
use Livewire\Livewire;

test('login screen can be rendered', function () {
    Livewire::test(\App\Livewire\Auth\Login::class)->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    Livewire::test(\App\Livewire\Auth\Login::class)
        ->set('form.email', $user->email)
        ->set('form.password', 'password')
        ->call('login')
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    Livewire::test(\App\Livewire\Auth\Login::class)
        ->set('form.email', $user->email)
        ->set('form.password', 'wrong-password')
        ->call('login')
        ->assertHasErrors()
        ->assertNoRedirect();

    $this->assertGuest();
});

test('navigation menu can be rendered', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(\App\Livewire\Navigation::class)->assertStatus(200);
});

test('users can logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(\App\Livewire\Navigation::class)
        ->call('logout')
        ->assertHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
});
