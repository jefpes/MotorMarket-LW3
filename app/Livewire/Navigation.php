<?php

namespace App\Livewire;

use App\Enums\Permission;
use App\Livewire\Actions\Logout;
use App\Utilities\Navigation as UtilitiesNavigation;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Navigation extends Component
{
    public function render(): View
    {
        return view('livewire.navigation2');
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }

    public function setLang(string $lang): void
    {
        session(['localization' => $lang]);
        $this->redirect(url()->previous());
    }

    /** @return array<object> */
    #[Computed()]
    public function navs(): array
    {
        return [
            UtilitiesNavigation::createNavItem('dashboard', 'Dashboard', Permission::ADMIN),
            UtilitiesNavigation::createNavItem('company', 'Company', Permission::COMPANY_UPDATE),
            UtilitiesNavigation::createNavItem('users', 'Users', Permission::USER_READ, ['user.roles']),
            UtilitiesNavigation::createNavItem('roles', 'Roles', Permission::ADMIN, ['roles', 'ability.role']),
            UtilitiesNavigation::createNavItem('city', 'Cities', Permission::CITY_READ),
            UtilitiesNavigation::createNavItem('client', 'Clients', Permission::CLIENT_READ, ['client.create', 'client.edit', 'client.show']),
            UtilitiesNavigation::createNavItem('supplier', 'Suppliers', Permission::SUPPLIER_READ, ['supplier.create', 'supplier.edit', 'supplier.show']),
            UtilitiesNavigation::createNavItem('employee', 'Employees', Permission::EMPLOYEE_READ, ['employee.create', 'employee.edit', 'employee.show']),
            UtilitiesNavigation::createNavItem('sales', 'Sales', Permission::SALE_READ, ['sale.create', 'sale.show']),
            UtilitiesNavigation::createNavItem('installments', 'Installments', Permission::INSTALLMENT_READ, ['sale.installments']),
            UtilitiesNavigation::createNavItem('vehicle-expense', 'Expenses', Permission::VEHICLE_EXPENSE_READ),
        ];
    }

    /** @return array<object> */
    #[Computed()]
    public function vehicleNavs(): array
    {
        return [
            UtilitiesNavigation::createNavItem('brand', 'Brands', Permission::BRAND_READ),
            UtilitiesNavigation::createNavItem('vtype', 'Vehicle Type', Permission::VEHICLE_TYPE_READ),
            UtilitiesNavigation::createNavItem('vmodel', 'Vehicle Model', Permission::VEHICLE_MODEL_READ),
            UtilitiesNavigation::createNavItem('vehicle', 'Vehicles', Permission::VEHICLE_READ, ['vehicle.create', 'vehicle.edit', 'vehicle.show']),
        ];
    }

    /** @return array<object> */
    #[Computed()]
    public function responsiveNavs(): array
    {
        return [
            UtilitiesNavigation::createNavItem('dashboard', 'Dashboard', Permission::ADMIN),
            UtilitiesNavigation::createNavItem('company', 'Company', Permission::COMPANY_UPDATE),
            UtilitiesNavigation::createNavItem('users', 'Users', Permission::USER_READ, ['user.roles']),
            UtilitiesNavigation::createNavItem('roles', 'Roles', Permission::ADMIN, ['roles', 'ability.role']),
            UtilitiesNavigation::createNavItem('brand', 'Brands', Permission::BRAND_READ),
            UtilitiesNavigation::createNavItem('vtype', 'Vehicle Type', Permission::VEHICLE_TYPE_READ),
            UtilitiesNavigation::createNavItem('vmodel', 'Vehicle Model', Permission::VEHICLE_MODEL_READ),
            UtilitiesNavigation::createNavItem('vehicle', 'Vehicles', Permission::VEHICLE_READ, ['vehicle.create', 'vehicle.edit', 'vehicle.show']),
            UtilitiesNavigation::createNavItem('city', 'Cities', Permission::CITY_READ),
            UtilitiesNavigation::createNavItem('client', 'Clients', Permission::CLIENT_READ, ['client.create', 'client.edit', 'client.show']),
            UtilitiesNavigation::createNavItem('supplier', 'Suppliers', Permission::SUPPLIER_READ, ['supplier.create', 'supplier.edit', 'supplier.show']),
            UtilitiesNavigation::createNavItem('employee', 'Employees', Permission::EMPLOYEE_READ, ['employee.create', 'employee.edit', 'employee.show']),
            UtilitiesNavigation::createNavItem('sales', 'Sales', Permission::SALE_READ, ['sale.create', 'sale.show']),
            UtilitiesNavigation::createNavItem('installments', 'Installments', Permission::INSTALLMENT_READ, ['sale.installments']),
            UtilitiesNavigation::createNavItem('vehicle-expense', 'Expenses', Permission::VEHICLE_EXPENSE_READ),
        ];
    }
}
