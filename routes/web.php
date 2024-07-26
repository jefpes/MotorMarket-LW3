<?php

use App\Enums\Permission;
use App\Http\Middleware\{ CheckRoleHierarchy, CheckUserHierarchy, Localization, SaleCanceled};
use App\Livewire\Ability\AbilityRole;
use App\Livewire\Role;
use App\Livewire\User\{ UserRole };
use App\Livewire\{Brand, City, Client, Company, Dashboard, Employee, Home, PaymentInstallments, Profile, Reports, Sales, Supplier, User, Vehicle, VehicleExpense, VehicleModel, VehicleType};
use Illuminate\Support\Facades\Route;

Route::middleware(Localization::class)->group(function () {

    Route::get('/', Home\Index::class)->name('home');

    Route::get('/show/{id}', Home\Show::class)->name('show.v');

    Route::get('/company', Company\Update::class)->middleware(['auth', 'verified', 'can:company_update'])->name('company');

    Route::get('dashboard', Dashboard::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('users', User\Index::class)
        ->middleware(['auth', 'can:' . Permission::USER_READ->value, 'verified'])
        ->name('users');

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
        ->middleware(['auth', 'verified', 'can:' . Permission::BRAND_READ->value])
        ->name('brand');

    Route::get('vmodel', VehicleModel\Index::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::VEHICLE_MODEL_READ->value])
        ->name('vmodel');

    Route::get('vtype', VehicleType\Index::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::VEHICLE_TYPE_READ->value])
        ->name('vtype');

    Route::get('vehicle', Vehicle\Index::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::VEHICLE_READ->value])
        ->name('vehicle');

    Route::get('vehicle_create', Vehicle\Create::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::VEHICLE_CREATE->value])
        ->name('vehicle.create');

    Route::get('vehicle_edit/{id}', Vehicle\Update::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::VEHICLE_UPDATE->value])
        ->name('vehicle.edit');

    Route::get('vehicle/{id}', Vehicle\Show::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::VEHICLE_READ->value])
        ->name('vehicle.show');

    Route::get('city', City\Index::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::CITY_READ->value])
        ->name('city');

    Route::get('client', Client\Index::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::CLIENT_READ->value])
        ->name('client');

    Route::get('client_create', Client\Create::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::CLIENT_CREATE->value])
        ->name('client.create');

    Route::get('client_edit/{id}', Client\Update::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::CLIENT_UPDATE->value])
        ->name('client.edit');

    Route::get('client/{id}', Client\Show::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::CLIENT_READ->value])
        ->name('client.show');

    Route::get('supplier', Supplier\Index::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::CLIENT_READ->value])
        ->name('supplier');

    Route::get('supplier_create', Supplier\Create::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::CLIENT_CREATE->value])
        ->name('supplier.create');

    Route::get('supplier_edit/{id}', Supplier\Update::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::CLIENT_UPDATE->value])
        ->name('supplier.edit');

    Route::get('supplier/{id}', Supplier\Show::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::CLIENT_READ->value])
        ->name('supplier.show');

    Route::get('employee', Employee\Index::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::EMPLOYEE_READ->value])
        ->name('employee');

    Route::get('employee_create', Employee\Create::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::EMPLOYEE_CREATE->value])
        ->name('employee.create');

    Route::get('employee_edit/{id}', Employee\Update::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::EMPLOYEE_UPDATE->value])
        ->name('employee.edit');

    Route::get('employee/{id}', Employee\Show::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::EMPLOYEE_READ->value])
        ->name('employee.show');

    Route::get('sales', Sales\Index::class)
            ->middleware(['auth', 'verified', 'can:' . Permission::SALE_READ->value])
            ->name('sales');

    Route::get('sale_create/{id}', Sales\Create::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::SALE_CREATE->value])
        ->name('sale.create');

    Route::get('sale/{id}', Sales\Show::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::SALE_READ->value])
        ->name('sale.show');

    Route::get('sale/{id}/contract', Reports\SalesContract::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::SALE_READ->value, SaleCanceled::class])
        ->name('contract');

    Route::get('sale/{id}/receipt', Reports\Receipt::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::SALE_READ->value])
        ->name('receipt.sale');

    Route::get('sale/{id}/installments', PaymentInstallments\SaleInstallment::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::INSTALLMENT_READ->value, SaleCanceled::class])
        ->name('sale.installments');

    Route::get('installments', PaymentInstallments\Index::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::INSTALLMENT_READ->value])
        ->name('installments');

    Route::get('vehicle-expense', VehicleExpense\Index::class)
        ->middleware(['auth', 'verified', 'can:' . Permission::VEHICLE_EXPENSE_READ->value])
        ->name('vehicle-expense');

    require __DIR__ . '/auth.php';
});
