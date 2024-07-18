<?php

namespace App\Livewire\Home;

use App\Models\{Brand, Company, Vehicle, VehicleType};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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

    #[Url(except: '', history: true)]
    public ?string $order = 'asc';

    #[Url(except: '', history: true)]
    public ?string $max_price = null;

    #[Url(except: '', as: 't', history: true)]
    public ?string $type = null;

    #[Layout('components.layouts.home')]
    public function render(): View
    {
        return view('livewire.home.index', ['company' => Company::find(1), 'types' => VehicleType::all()]);
    }

    #[Computed()]
    public function years(): Collection
    {
        return Vehicle::whereSoldDate(null)
            ->when($this->selectedBrands, fn ($query) => $query->whereHas('model', fn ($query) => $query->whereIn('brand_id', $this->selectedBrands)))
            ->when($this->type, fn ($query) => $query->whereHas('model', fn ($query) => $query->where('vehicle_type_id', $this->type)))
            ->when($this->max_price, fn ($query) => $query->where('sale_price', '<=', $this->max_price))
            ->select('year_one')
            ->distinct()
            ->orderBy('year_one')
            ->get();
    }

    #[Computed()]
    public function vehicles(): LengthAwarePaginator
    {
        return Vehicle::with('model', 'photos')
            ->whereSoldDate(null)
            ->when($this->selectedBrands, fn ($query) => $query->whereHas('model', fn ($query) => $query->whereIn('brand_id', $this->selectedBrands)))
            ->when($this->year_ini, fn ($query) => $query->where('year_one', '>=', $this->year_ini))
            ->when($this->year_end, fn ($query) => $query->where('year_one', '<=', $this->year_end))
            ->when($this->order, fn ($query) => $query->orderBy('sale_price', $this->order))
            ->when($this->max_price, fn ($query) => $query->where('sale_price', '<=', $this->max_price))
            ->when($this->type, fn ($query) => $query->whereHas('model', fn ($query) => $query->where('vehicle_type_id', $this->type)))
            ->paginate();
    }

    #[Computed()]
    public function prices(): Collection
    {
        return Vehicle::whereSoldDate(null)
            ->when($this->selectedBrands, fn ($query) => $query->whereHas('model', fn ($query) => $query->whereIn('brand_id', $this->selectedBrands)))
            ->when($this->year_ini, fn ($query) => $query->where('year_one', '>=', $this->year_ini))
            ->when($this->year_end, fn ($query) => $query->where('year_one', '<=', $this->year_end))
            ->when($this->type, fn ($query) => $query->whereHas('model', fn ($query) => $query->where('vehicle_type_id', $this->type)))
            ->select('sale_price')
            ->distinct()
            ->orderBy('sale_price')
            ->get();
    }

    #[Computed()]
    public function brands(): Collection
    {
        return Brand::join('vehicle_models', 'brands.id', '=', 'vehicle_models.brand_id')
              ->join('vehicles', 'vehicle_models.id', '=', 'vehicles.vehicle_model_id')
              ->select('brands.*')
              ->distinct()
              ->where('vehicles.sold_date', '=', null)
              ->when($this->type, fn (Builder $q) => $q->where('vehicle_models.vehicle_type_id', $this->type))
              ->orderBy('brands.name')
              ->get();
    }

    public function clean(): void
    {
        $this->reset(['selectedBrands', 'year_ini', 'year_end', 'order', 'max_price', 'type']);
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
        $this->reset('selectedBrands');
        $this->resetPage();
    }
}
