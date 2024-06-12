<?php

namespace App\Livewire;

use App\Models\{Role, Sale, User, Vehicle, VehicleType};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(): View
    {
        return view('livewire.dashboard');
    }

    #[Computed()]
    public function users(): int
    {
        return User::count();
    }

    #[Computed()]
    public function usersNoFunction(): int
    {
        return User::whereDoesntHave('roles')->count();
    }

    #[Computed()]
    public function roles(): Collection
    {
        return Role::withCount('users')->get();
    }

    #[Computed()]
    public function stock(): Collection
    {
        return Vehicle::with('type')->get();
    }

    #[Computed()]
    public function vType(): Collection
    {
        return VehicleType::withCount('vehicles')->get();
    }

    #[Computed()]
    public function vTypeCount(): Collection
    {
        return Vehicle::withCount('type')->get();
    }

    #[Computed()]
    public function sales(): Collection
    {
        return Sale::with('vehicle')->get();
    }
}
