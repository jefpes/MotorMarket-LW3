<?php

use App\Http\Middleware\{ CheckRoleHierarchy, CheckUserHierarchy, Localization, SaleCanceled};
use App\Livewire\Ability\AbilityRole;
use App\Livewire\Role;
use App\Livewire\User\{ UserRole };
use App\Livewire\{Brand, City, Client, Company, Dashboard, Home, PaymentInstallments, Profile, Sales, User, Vehicle, VehicleExpense, VehicleModel, VehicleType};
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPdf\Facades\Pdf;

Route::middleware(Localization::class)->group(function () {

    Route::get('/', Home\Index::class)->name('home');

    Route::get('/show/{id}', Home\Show::class)->name('show.v');

    Route::get('/company', Company\Edit::class)->middleware(['auth', 'verified', 'can:company_update'])->name('company');

    Route::get('dashboard', Dashboard::class)
        ->middleware(['auth', 'verified', 'can:admin'])
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
        ->middleware(['auth', 'verified', 'can:brand_read'])
        ->name('brand');

    Route::get('vmodel', VehicleModel\Index::class)
        ->middleware(['auth', 'verified', 'can:vmodel_read'])
        ->name('vmodel');

    Route::get('vtype', VehicleType\Index::class)
        ->middleware(['auth', 'verified', 'can:vtype_read'])
        ->name('vtype');

    Route::get('vehicle', Vehicle\Index::class)
        ->middleware(['auth', 'verified', 'can:vehicle_read'])
        ->name('vehicle');

    Route::get('vehicle_create', Vehicle\Create::class)
        ->middleware(['auth', 'verified', 'can:vehicle_create'])
        ->name('vehicle.create');

    Route::get('vehicle_edit/{id}', Vehicle\Update::class)
        ->middleware(['auth', 'verified', 'can:vehicle_update'])
        ->name('vehicle.edit');

    Route::get('vehicle_show/{id}', Vehicle\Show::class)
        ->middleware(['auth', 'verified', 'can:vehicle_read'])
        ->name('vehicle.show');

    Route::get('city', City\Index::class)
        ->middleware(['auth', 'verified', 'can:city_read'])
        ->name('city');

    Route::get('client', Client\Index::class)
        ->middleware(['auth', 'verified', 'can:client_read'])
        ->name('client');

    Route::get('client_create', Client\Create::class)
        ->middleware(['auth', 'verified', 'can:client_create'])
        ->name('client.create');

    Route::get('client_edit/{id}', Client\Update::class)
        ->middleware(['auth', 'verified', 'can:client_update'])
        ->name('client.edit');

    Route::get('client_show/{id}', Client\Show::class)
        ->middleware(['auth', 'verified', 'can:client_read'])
        ->name('client.show');

    Route::get('sales', Sales\Index::class)
            ->middleware(['auth', 'verified', 'can:sale_read'])
            ->name('sales');

    Route::get('sale_create/{id}', Sales\Create::class)
        ->middleware(['auth', 'verified', 'can:sale_create'])
        ->name('sale.create');

    Route::get('sale/{id}/contract', function () {

        // return Pdf::view('components.reports.contract')->format('a4')->save('invoice.pdf');

        return view('components.reports.contract');
    })->name('contract');

    Route::get('sale/{id}/installments', PaymentInstallments\SaleInstallment::class)
        ->middleware(['auth', 'verified', 'can:installment_read', SaleCanceled::class])
        ->name('sale.installments');

    Route::get('installments', PaymentInstallments\Index::class)
        ->middleware(['auth', 'verified', 'can:installment_read'])
        ->name('installments');

    Route::get('vehicle-expense', VehicleExpense\Index::class)
        ->middleware(['auth', 'verified', 'can:expense_read'])
        ->name('vehicle-expense');

    require __DIR__ . '/auth.php';
});
