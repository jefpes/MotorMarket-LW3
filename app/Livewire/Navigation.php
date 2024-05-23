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

        $this->redirect('/', navigate: true);
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
            (object)['route' => 'dashboard', 'label' => 'Dashboard', 'permission' => null, 'isActive' => request()->routeIs('dashboard')],
            (object)['route' => 'users', 'label' => 'Users', 'permission' => 'user_read', 'isActive' => request()->routeIs('users', 'users.create', 'users.edit')],
            (object)['route' => 'roles', 'label' => 'Roles', 'permission' => 'admin', 'isActive' => request()->routeIs('roles', 'ability.role')],
            (object)['route' => 'brand', 'label' => 'Brands', 'permission' => 'brand_read', 'isActive' => request()->routeIs('brand')],
        ];
    }

}
