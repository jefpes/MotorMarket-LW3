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
            (object)['route' => 'city', 'label' => 'Cities', 'permission' => 'city_read', 'isActive' => request()->routeIs('city')],
            (object)['route' => 'group', 'label' => 'Groups', 'permission' => 'group_read', 'isActive' => request()->routeIs('group')],
            (object)['route' => 'people', 'label' => 'People', 'permission' => 'people_read', 'isActive' => request()->routeIs('people', 'people.create', 'people.edit', 'people.show')],
        ];
    }

}
