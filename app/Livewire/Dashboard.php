<?php

namespace App\Livewire;

use App\Models\{Role, Sale, User, Vehicle, VehicleType};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
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
        return Vehicle::where('sold_date', null)->with('type')->get();
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

    #[Computed()]
    public function salesType(): Collection
    {
        return Sale::join('vehicles', 'sales.vehicle_id', '=', 'vehicles.id')
                  ->join('vehicle_types', 'vehicles.vehicle_type_id', '=', 'vehicle_types.id')
                  ->select(
                      'vehicle_types.name',
                      DB::raw('COUNT(sales.id) as number_of_sales'),
                      DB::raw('SUM(sales.total) as total_sales'),
                      DB::raw('SUM(vehicles.purchase_price) as total_purchase_price'),
                      DB::raw('SUM(sales.total) - SUM(vehicles.purchase_price) as profit')
                  )
                  ->groupBy('vehicle_types.name')
                  ->get();

    }
}
