<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Illuminate\Contracts\View\View;
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

    /** @var array<object> */
    public array $navs;

    public function mount(): void
    {
        $this->navs = [
            (object)['route' => 'dashboard', 'label' => 'Dashboard', 'permission' => 'admin', 'isActive' => request()->routeIs('dashboard')],
            (object)['route' => 'company', 'label' => 'Company', 'permission' => 'company_update', 'isActive' => request()->routeIs('company')],
            (object)['route' => 'users', 'label' => 'Users', 'permission' => 'user_read', 'isActive' => request()->routeIs('users', 'users.create', 'users.edit')],
            (object)['route' => 'roles', 'label' => 'Roles', 'permission' => 'admin', 'isActive' => request()->routeIs('roles', 'ability.role')],
            (object)['route' => 'brand', 'label' => 'Brands', 'permission' => 'brand_read', 'isActive' => request()->routeIs('brand')],
            (object)['route' => 'vtype', 'label' => 'Vehicle Type', 'permission' => 'vtype_read', 'isActive' => request()->routeIs('vtype')],
            (object)['route' => 'vmodel', 'label' => 'Vehicle Model', 'permission' => 'vmodel_read', 'isActive' => request()->routeIs('vmodel')],
            (object)['route' => 'vehicle', 'label' => 'Vehicles', 'permission' => 'vehicle_read', 'isActive' => request()->routeIs('vehicle', 'vehicle.create', 'vehicle.edit', 'vehicle.show')],
            (object)['route' => 'city', 'label' => 'Cities', 'permission' => 'city_read', 'isActive' => request()->routeIs('city')],
            (object)['route' => 'client', 'label' => 'Clients', 'permission' => 'client_read', 'isActive' => request()->routeIs('client', 'client.create', 'client.edit', 'client.show')],
            (object)['route' => 'employee', 'label' => 'Employees', 'permission' => 'employee_read', 'isActive' => request()->routeIs('employee', 'employee.create', 'employee.edit', 'employee.show')],
            (object)['route' => 'sales', 'label' => 'Sales', 'permission' => 'sale_read', 'isActive' => request()->routeIs('sales', 'sale.create')],
            (object)['route' => 'installments', 'label' => 'Installments', 'permission' => 'installment_read', 'isActive' => request()->routeIs('installments', 'sale.installments')],
            (object)['route' => 'vehicle-expense', 'label' => 'Expenses', 'permission' => 'vexpense_read', 'isActive' => request()->routeIs('vehicle-expense')],
        ];
    }

}
