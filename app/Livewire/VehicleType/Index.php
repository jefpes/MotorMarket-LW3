<?php

namespace App\Livewire\VehicleType;

use App\Enums\Permission;
use App\Livewire\Forms\VehicleTypeForm;
use App\Models\{VehicleType};
use App\Traits\SortTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Index extends Component
{
    use SortTable;

    public VehicleTypeForm $form;

    public string $header = 'Vehicle Types';

    /** @var array<String> */
    public array $thead = ['Name', 'Actions'];

    /** @return array<object> */
    #[Computed()]
    public function table(): array
    {
        return [
            (object)['field' => 'name', 'head' => 'Name'],
            (object)['field' => 'actions', 'head' => 'Actions'],
        ];
    }

    public function mount(): void
    {
        $this->setInitialColumn('name');
    }

    #[On('vtype::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle-type.index', ['permission' => Permission::class]);
    }

    #[Computed]
    public function data(): Collection
    {
        return VehicleType::orderBy($this->sortColumn, $this->sortDirection)->get();
    }
}
