<?php

namespace App\Livewire;

use App\Enums\{PaymentMethod, StatusPayments};
use App\Models\{Role, Sale, User, Vehicle, VehicleType};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{
    public string $date_ini = '';

    public string $date_end = '';

    public string $status = '';

    public string $payment_method = '';

    public function mount(): void
    {
        $this->date_ini = now()->subMonth()->format('Y-m-d');
        $this->date_end = now()->format('Y-m-d');
    }

    public function render(): View
    {
        return view('livewire.dashboard', ['sts' => StatusPayments::cases(), 'payment_methods' => PaymentMethod::cases()]);
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
    public function salesFilter(): Collection
    {
        return Sale::with('vehicle')
          ->when($this->date_ini && $this->date_end, fn ($q) => $q->whereBetween('date_sale', [$this->date_ini, $this->date_end]))
          ->when($this->status, fn ($q) => $q->where('sales.status', $this->status))
          ->when($this->payment_method, fn ($q) => $q->where('sales.payment_method', $this->payment_method))
          ->get();
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

    #[Computed()]
    public function salesTypeFilter(): Collection
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
                  ->when($this->date_ini && $this->date_end, fn ($q) => $q->whereBetween('sales.date_sale', [$this->date_ini, $this->date_end]))
                  ->when($this->status, fn ($q) => $q->where('sales.status', $this->status))
                  ->when($this->payment_method, fn ($q) => $q->where('sales.payment_method', $this->payment_method))
                  ->get();
    }
}
