<?php

use App\Http\Middleware\{ CheckRoleHierarchy, CheckUserHierarchy, Localization };
use App\Livewire\Ability\AbilityRole;
use App\Livewire\Role;
use App\Livewire\User\{ UserRole };
use App\Livewire\{Brand, Dashboard, Profile, User};
use Illuminate\Support\Facades\Route;

Route::middleware(Localization::class)->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('dashboard', Dashboard::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('users', User\Index::class)
        ->middleware(['auth', 'can:user_read', 'verified'])
        ->name('users');

    Route::get('users-create', User\Create::class)
        ->middleware(['auth', 'can:user_create', 'verified'])
        ->name('users.create');

    Route::get('users-edit/{id}', User\Edit::class)
        ->middleware(['auth', 'can:user_update', 'verified', CheckUserHierarchy::class])
        ->name('users.edit');

    Route::get('user-roles/{id}', UserRole::class)
        ->middleware(['auth', 'can:admin', 'verified', CheckUserHierarchy::class])
        ->name('user.roles');

    Route::get('roles', Role\Index::class)
        ->middleware(['auth', 'can:admin', 'verified'])
        ->name('roles');

    Route::get('ability-roles/{id}', AbilityRole::class)
        ->middleware(['auth', 'can:admin', 'verified', CheckRoleHierarchy::class])
        ->name('ability.role');

    Route::get('profile', Profile::class)
        ->middleware(['auth', 'verified'])
        ->name('profile');

    Route::get('brand', Brand\Index::class)
        ->middleware(['auth', 'verified'])
        ->name('brand');

    require __DIR__ . '/auth.php';
});
