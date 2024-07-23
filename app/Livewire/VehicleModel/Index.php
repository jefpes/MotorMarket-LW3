<?php

namespace App\Livewire\VehicleModel;

use App\Enums\Permission;
use App\Livewire\Forms\VehicleModelForm;
use App\Models\VehicleType;
use App\Models\{Brand, VehicleModel};
use App\Traits\SortTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\{Builder, Collection};
use Livewire\Attributes\{Computed, On, Url};
use Livewire\Component;

class Index extends Component
{
    use SortTable;

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

    /** @return array<object> */
    #[Computed()]
    public function table(): array
    {
        return [
            (object)['field' => 'name', 'head' => 'name'],
            (object)['field' => 'brand', 'head' => 'brand'],
            (object)['field' => 'type', 'head' => 'type'],
            (object)['field' => 'actions', 'head' => 'Actions'],
        ];
    }

    public function mount(): void
    {
        $this->setInitialColumn('name');
    }

    #[On('vmodel::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle-model.index', [
            'brands'     => Brand::orderBy('name')->get(),
            'types'      => VehicleType::orderBy('name')->get(),
            'permission' => Permission::class,
        ]);
    }

    #[Computed()]
    public function vmodels(): Collection
    {
        return VehicleModel::join('brands', 'brands.id', '=', 'vehicle_models.brand_id')
                ->join('vehicle_types', 'vehicle_types.id', '=', 'vehicle_models.vehicle_type_id')
                ->when($this->brand_id, fn (Builder $q) => $q->where('brands.id', $this->brand_id))
                ->when($this->vehicle_type_id, fn (Builder $q) => $q->where('vehicle_types.id', $this->vehicle_type_id))
                ->when($this->search, fn (Builder $q) => $q->where('vehicle_models.name', 'like', "%{$this->search}%"))
                ->select('vehicle_models.*', 'brands.name as brand', 'vehicle_types.name as type')
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->get();
    }
}
