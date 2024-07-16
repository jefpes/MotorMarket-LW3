<?php

namespace App\Livewire\Vehicle;

use App\Models\{Brand, Vehicle, VehicleModel, VehicleType};
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public bool $modal = false;

    public string $header = 'Vehicles';

    #[Url(except: '', as: 'date-ini', history: true)]
    public string $date_i = '';

    #[Url(except: '', as: 'date-end', history: true)]
    public string $date_f = '';

    #[Url(except: '', as: 'plate', history: true)]
    public ?string $search = '';

    #[Url(except: null, as: 'type', history: true)]
    public ?int $vehicle_type_id = null;

    #[Url(except: null, as: 'brand', history: true)]
    public ?int $brand_id = null;

    #[Url(except: null, as: 'model', history: true)]
    public ?int $vehicle_model_id = null;

    #[Url(except: null, as: 'sold', history: true)]
    public ?bool $sold = false;

    #[On('vehicle::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle.index', ['types' => VehicleType::all()]);
    }

    #[Computed()]
    public function vehicle(): Paginator
    {
        return Vehicle::query()
                ->with('photos', 'model')
                ->when($this->search, fn (Builder $q) => $q->where('plate', 'like', "%{$this->search}%"))
                ->when($this->vehicle_type_id, fn (Builder $q) => $q->whereHas('model', function (Builder $q) {
                    $q->where('vehicle_type_id', $this->vehicle_type_id);
                }))
                ->when($this->vehicle_model_id, fn (Builder $q) => $q->whereHas('model', function (Builder $q) {
                    $q->where('id', $this->vehicle_model_id);
                }))
                ->when($this->brand_id, fn (Builder $q) => $q->whereHas('model', function (Builder $q) {
                    $q->where('brand_id', $this->brand_id);
                }))
                ->when($this->date_i && $this->date_f, fn (Builder $q) => $q->whereBetween('purchase_date', [$this->date_i, $this->date_f]))
                ->when($this->sold !== null, function (Builder $q) {
                    $q->where('sold_date', $this->sold ? '!=' : '=', null);
                })
                ->paginate();
    }

    #[Computed()]
    public function models(): Collection
    {
        return VehicleModel::join('vehicles', 'vehicle_models.id', '=', 'vehicles.vehicle_model_id')
        ->select('vehicle_models.*')
        ->distinct()
              ->where('vehicles.sold_date', '=', null)
              ->orderBy('vehicle_models.name')
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
              ->orderBy('brands.name')
              ->get();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedVehicleTypeId(): void
    {
        $this->resetPage();
    }

    public function updatedVehicleModelId(): void
    {
        $this->resetPage();
    }

    public function updatedDateI(): void
    {
        $this->resetPage();
    }

    public function updatedDateF(): void
    {
        $this->resetPage();
    }

    public function updatedSold(): void
    {
        $this->resetPage();
    }
}
