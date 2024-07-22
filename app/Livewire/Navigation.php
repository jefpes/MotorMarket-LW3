<?php

namespace App\Livewire;

use App\Enums\Permission;
use App\Livewire\Actions\Logout;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Navigation extends Component
{
    public function render(): View
    {
        return view('livewire.navigation');
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
            (object)['route' => 'dashboard', 'label' => 'Dashboard', 'permission' => Permission::ADMIN->value, 'isActive' => request()->routeIs('dashboard')],
            (object)['route' => 'company', 'label' => 'Company', 'permission' => Permission::COMPANY_UPDATE->value, 'isActive' => request()->routeIs('company')],
            (object)['route' => 'users', 'label' => 'Users', 'permission' => Permission::USER_READ->value, 'isActive' => request()->routeIs('users', 'users.create', 'users.edit')],
            (object)['route' => 'roles', 'label' => 'Roles', 'permission' => Permission::ADMIN->value, 'isActive' => request()->routeIs('roles', 'ability.role')],
            (object)['route' => 'brand', 'label' => 'Brands', 'permission' => Permission::BRAND_READ->value, 'isActive' => request()->routeIs('brand')],
            (object)['route' => 'vtype', 'label' => 'Vehicle Type', 'permission' => Permission::VEHICLE_TYPE_READ->value, 'isActive' => request()->routeIs('vtype')],
            (object)['route' => 'vmodel', 'label' => 'Vehicle Model', 'permission' => Permission::VEHICLE_MODEL_READ->value, 'isActive' => request()->routeIs('vmodel')],
            (object)['route' => 'vehicle', 'label' => 'Vehicles', 'permission' => Permission::VEHICLE_READ->value, 'isActive' => request()->routeIs('vehicle', 'vehicle.create', 'vehicle.edit', 'vehicle.show')],
            (object)['route' => 'city', 'label' => 'Cities', 'permission' => Permission::CITY_READ->value, 'isActive' => request()->routeIs('city')],
            (object)['route' => 'client', 'label' => 'Clients', 'permission' => Permission::CLIENT_READ->value, 'isActive' => request()->routeIs('client', 'client.create', 'client.edit', 'client.show')],
            (object)['route' => 'employee', 'label' => 'Employees', 'permission' => Permission::EMPLOYEE_READ->value, 'isActive' => request()->routeIs('employee', 'employee.create', 'employee.edit', 'employee.show')],
            (object)['route' => 'sales', 'label' => 'Sales', 'permission' => Permission::SALE_READ->value, 'isActive' => request()->routeIs('sales', 'sale.create')],
            (object)['route' => 'installments', 'label' => 'Installments', 'permission' => Permission::INSTALLMENT_READ->value, 'isActive' => request()->routeIs('installments', 'sale.installments')],
            (object)['route' => 'vehicle-expense', 'label' => 'Expenses', 'permission' => Permission::VEHICLE_EXPENSE_READ->value, 'isActive' => request()->routeIs('vehicle-expense')],
        ];
    }
}
