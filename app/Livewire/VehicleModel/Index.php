<?php

namespace App\Livewire\VehicleModel;

use App\Livewire\Forms\VehicleModelForm;
use App\Models\VehicleType;
use App\Models\{Brand, VehicleModel};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\{Builder, Collection};
use Livewire\Attributes\{Computed, On, Url};
use Livewire\Component;

class Index extends Component
{
    public VehicleModelForm $form;

    public string $header = 'Vehicle Models';

    #[Url(except: '', as: 'name', history: true)]
    public ?string $search = '';

    #[Url(except: null, as: 'brand', history: true)]
    public ?int $brand_id = null;

    #[Url(except: null, as: 'type', history: true)]
    public ?int $vehicle_type_id = null;

    /** @var array<String> */
    public array $thead = ['name', 'brand', 'type', 'actions'];

    #[On('vmodel::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle-model.index', [
            'brands' => Brand::orderBy('name')->get(),
            'types'  => VehicleType::orderBy('name')->get(),
        ]);
    }

    #[Computed()]
    public function vmodels(): Collection
    {
        return VehicleModel::with('brand', 'type')
        ->orderBy('name')
        ->when($this->brand_id, fn (Builder $q) => $q->whereHas('brand', function (Builder $q) {
            $q->whereId($this->brand_id);
        }))
        ->when($this->vehicle_type_id, fn (Builder $q) => $q->whereHas('type', function (Builder $q) {
            $q->whereId($this->vehicle_type_id);
        }))
        ->when($this->search, fn (Builder $q) => $q->where('name', 'like', "%{$this->search}%"))
        ->get();
    }
}
