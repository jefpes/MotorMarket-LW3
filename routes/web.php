<?php

use App\Http\Middleware\{ CheckRoleHierarchy, CheckUserHierarchy, Localization };
use App\Livewire\Ability\AbilityRole;
use App\Livewire\Role;
use App\Livewire\User\{ UserRole };
use App\Livewire\{Brand, Client, Dashboard, Profile, User, Vehicle, VehicleModel, VehicleType};
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

    Route::get('vmodel', VehicleModel\Index::class)
        ->middleware(['auth', 'verified'])
        ->name('vmodel');

    Route::get('vtype', VehicleType\Index::class)
        ->middleware(['auth', 'verified'])
        ->name('vtype');

    Route::get('vehicle', Vehicle\Index::class)
        ->middleware(['auth', 'verified'])
        ->name('vehicle');

    Route::get('vehicle_create', Vehicle\Create::class)
        ->middleware(['auth', 'verified'])
        ->name('vehicle.create');

    Route::get('vehicle_edit/{id}', Vehicle\Update::class)
        ->middleware(['auth', 'verified'])
        ->name('vehicle.edit');

    Route::get('vehicle_show/{id}', Vehicle\Show::class)
        ->middleware(['auth', 'verified'])
        ->name('vehicle.show');

    Route::get('client', Client\Index::class)
        ->middleware(['auth', 'verified'])
        ->name('client');

    Route::get('client_create', Client\Create::class)
        ->middleware(['auth', 'verified'])
        ->name('client.create');

    Route::get('client_edit/{id}', Client\Update::class)
        ->middleware(['auth', 'verified'])
        ->name('client.edit');

    Route::get('client_show/{id}', Client\Show::class)
        ->middleware(['auth', 'verified'])
        ->name('client.show');

    require __DIR__ . '/auth.php';
});
