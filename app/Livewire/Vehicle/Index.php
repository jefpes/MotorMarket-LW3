<?php

namespace App\Livewire\Vehicle;

use App\Models\{ Vehicle, VehicleModel, VehicleType};
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public string $header = 'Vehicles';

    #[Url(except: '', as: 'date-ini', history: true)]
    public string $date_i = '';

    #[Url(except: '', as: 'date-end', history: true)]
    public string $date_f = '';

    #[Url(except: '', as: 'plate', history: true)]
    public ?string $search = '';

    #[Url(except: null, as: 'type', history: true)]
    public ?int $vehicle_type_id = null;

    #[Url(except: null, as: 'model', history: true)]
    public ?int $vehicle_model_id = null;

    #[On('vehicle::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle.index', ['models' => VehicleModel::all(), 'types' => VehicleType::all()]);
    }

    #[Computed()]
    public function vehicle(): Paginator
    {
        return Vehicle::query()
                ->with('photos', 'type', 'model')
                ->when($this->search, fn (Builder $q) => $q->where('plate', 'like', "%{$this->search}%"))
                ->when($this->vehicle_type_id, fn (Builder $q) => $q->whereHas('type', function (Builder $q) {
                    $q->where('id', $this->vehicle_type_id);
                }))
                ->when($this->vehicle_model_id, fn (Builder $q) => $q->whereHas('model', function (Builder $q) {
                    $q->where('id', $this->vehicle_model_id);
                }))
                ->when($this->date_i && $this->date_f, fn (Builder $q) => $q->whereBetween('purchase_date', [$this->date_i, $this->date_f]))
                ->paginate();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
}