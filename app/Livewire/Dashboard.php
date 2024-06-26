<?php

namespace App\Livewire;

use App\Enums\{PaymentMethod, StatusPayments};
use App\Models\{Role, Sale, User, Vehicle, VehicleExpense, VehicleType};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{
    public ?string $date_ini = '';

    public ?string $date_end = '';

    public ?string $status = '';

    public ?string $payment_method = '';

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
    public function vehicles(): object
    {
        $total = Vehicle::whereNull('sold_date')->count();

        $totalByType = VehicleType::join('vehicle_models', 'vehicle_types.id', '=', 'vehicle_models.vehicle_type_id')
                ->join('vehicles', 'vehicle_models.id', '=', 'vehicles.vehicle_model_id')
                ->leftJoin('vehicle_expenses', 'vehicles.id', '=', 'vehicle_expenses.vehicle_id')
                ->select(
                    DB::raw('COUNT(DISTINCT vehicles.id) as total_vehicles'),
                    DB::raw('SUM(vehicles.purchase_price) as total_purchase_price'),
                    DB::raw('SUM(vehicles.sale_price) as total_sale_price'),
                    DB::raw('SUM(vehicle_expenses.value) as total_expenses'),
                    DB::raw('SUM(vehicle_expenses.value) + SUM(vehicles.purchase_price) as total_stock')
                )
                ->whereNull('vehicles.sold_date')
                ->groupBy('vehicle_types.name')
                ->get();

        $totalPurchasePrice = Vehicle::sum('purchase_price');

        $totalSalePrice = Vehicle::sum('sale_price');

        $totalExpenses = VehicleExpense::sum('value');

        return (object)[
            'total'              => $total,
            'totalByType'        => $totalByType,
            'totalPurchasePrice' => $totalPurchasePrice,
            'totalSalePrice'     => $totalSalePrice,
            'totalExpenses'      => $totalExpenses,
        ];
    }

    #[Computed()]
    public function sales(): object
    {
        $count = Sale::with('vehicle')
          ->when($this->date_ini && $this->date_end, fn ($q) => $q->whereBetween('date_sale', [$this->date_ini, $this->date_end]))
          ->when($this->status, fn ($q) => $q->where('sales.status', $this->status))
          ->when($this->payment_method, fn ($q) => $q->where('sales.payment_method', $this->payment_method))
          ->count();

        $byType = Sale::join('vehicles', 'sales.vehicle_id', '=', 'vehicles.id')
                  ->join('vehicle_models', 'vehicles.vehicle_model_id', '=', 'vehicle_models.id')
                  ->join('vehicle_types', 'vehicle_models.vehicle_type_id', '=', 'vehicle_types.id')
                      ->leftJoin('vehicle_expenses', 'vehicles.id', '=', 'vehicle_expenses.vehicle_id')
                  ->select(
                      'vehicle_types.name',
                      DB::raw('COUNT(sales.id) as number_of_sales'),
                      DB::raw('SUM(sales.total) as total_sales'),
                      DB::raw('SUM(vehicles.purchase_price) as total_purchase_price'),
                      DB::raw('COALESCE(SUM(vehicle_expenses.value), 0) as total_expenses'),
                      DB::raw('SUM(sales.total) - SUM(vehicles.purchase_price) - COALESCE(SUM(vehicle_expenses.value), 0) as profit')
                  )
                  ->groupBy('vehicle_types.name')
                  ->when($this->date_ini && $this->date_end, fn ($q) => $q->whereBetween('sales.date_sale', [$this->date_ini, $this->date_end]))
                  ->when($this->status, fn ($q) => $q->where('sales.status', $this->status))
                  ->when($this->payment_method, fn ($q) => $q->where('sales.payment_method', $this->payment_method))
                  ->get();

        return (object)[
            'count'  => $count,
            'byType' => $byType,
        ];
    }
}
