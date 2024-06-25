<?php

namespace App\Livewire\Home;

use App\Models\{Brand, Company, Vehicle, VehicleType};
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, Layout, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public bool $modal = false;

    /** @var array<int> */
    public ?array $selectedBrands = [];

    #[Url(except: '', as: 'y-i', history: true)]
    public ?string $year_ini = '';

    #[Url(except: '', as: 'y-e', history: true)]
    public ?string $year_end = '';

    public ?string $year_min = '';

    public ?string $year_max = '';

    #[Url(except: '', as: 'order', history: true)]
    public ?string $order = 'asc';

    #[Url(except: '', as: 'm-p', history: true)]
    public ?float $max_price = null;

    #[Url(except: '', as: 't', history: true)]
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
        return view('livewire.home.index', ['company' => Company::find(1), 'max_prices' => Vehicle::max('sale_price'), 'types' => VehicleType::all()]);
    }

    #[Computed()]
    public function vehicles(): LengthAwarePaginator
    {
        return Vehicle::with('model', 'photos')
            ->orderBy('updated_at', 'desc')
            ->where('sold_date', '=', null)
            ->when($this->selectedBrands, fn ($query) => $query->whereHas('model', fn ($query) => $query->whereIn('brand_id', $this->selectedBrands)))
            ->when($this->year_ini && $this->year_end, fn ($query) => $query->whereBetween('year_one', [$this->year_ini, $this->year_end]))
            ->when($this->order, fn ($query) => $query->orderBy('sale_price', $this->order))
            ->when($this->max_price, fn ($query) => $query->where('sale_price', '<=', $this->max_price))
            ->when($this->type, fn ($query) => $query->whereHas('model', fn ($query) => $query->where('vehicle_type_id', $this->type)))
            ->paginate();
    }

    #[Computed()]
    public function brands(): \Illuminate\Support\Collection
    {
        return Brand::join('vehicle_models', 'brands.id', '=', 'vehicle_models.brand_id')
              ->join('vehicles', 'vehicle_models.id', '=', 'vehicles.vehicle_model_id')
              ->select('brands.*')
              ->distinct()
              ->where('vehicles.sold_date', '=', null)
              ->orderBy('brands.name')
              ->get();
    }

    public function cancel(): void
    {
        $this->modal = false;
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
