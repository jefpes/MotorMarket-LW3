<?php

namespace App\Livewire\Home;

use App\Models\{Brand, Company, Vehicle, VehicleType};
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, Layout};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public bool $modal = false;

    /** @var array<int> */
    public ?array $selectedBrands = [];

    public ?string $year_ini = '';

    public ?string $year_end = '';

    public ?string $year_min = '';

    public ?string $year_max = '';

    public ?string $order = 'asc';

    public ?float $max_price = null;

    public ?string $type = null;

    public function mount(): void
    {
        $this->year_ini = Vehicle::min('year_one');
        $this->year_end = Vehicle::max('year_one');
        $this->year_min = $this->year_ini;
        $this->year_max = $this->year_end;
    }

    #[Layout('components.layouts.home')]
    public function render(): View
    {
        return view('livewire.home.index', ['company' => Company::find(1), 'brands' => Brand::all(), 'max_prices' => Vehicle::max('sale_price'), 'types' => VehicleType::all()]);
    }

    #[Computed()]
    public function vehicles(): LengthAwarePaginator
    {
        return Vehicle::with('model', 'photos')
            ->orderBy('updated_at', 'desc')
            ->where('sold_date', '=', null)
            ->when(count($this->selectedBrands), fn ($query) => $query->whereHas('model', fn ($query) => $query->whereIn('brand_id', $this->selectedBrands)))
            ->when($this->year_ini && $this->year_end, fn ($query) => $query->whereBetween('year_one', [$this->year_ini, $this->year_end]))
            ->when($this->order, fn ($query) => $query->orderBy('sale_price', $this->order))
            ->when($this->max_price, fn ($query) => $query->where('sale_price', '<=', $this->max_price))
            ->when($this->type, fn ($query) => $query->whereHas('model', fn ($query) => $query->where('vehicle_type_id', $this->type)))
            ->paginate();
    }

    public function updatedSelectedBrands(): void
    {
        $this->resetPage();
    }

    public function updatedYearIni(): void
    {
        $this->resetPage();
    }

    public function updatedYearEnd(): void
    {
        $this->resetPage();
    }

    public function updatedOrder(): void
    {
        $this->resetPage();
    }

    public function updatedMaxPrice(): void
    {
        $this->resetPage();
    }

    public function updatedType(): void
    {
        $this->resetPage();
    }
}
