<?php

namespace App\Livewire\VehicleType;

use App\Livewire\Forms\VehicleTypeForm;
use App\Models\{VehicleType};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;
use stdClass;

class Index extends Component
{
    public VehicleTypeForm $form;

    public string $header = 'Vehicle Types';

    /** @var array<String> */
    public array $thead = ['Name', 'Actions'];

    #[On('vtype::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle-type.index');
    }

    #[Computed]
    public function data(): Collection
    {
        return VehicleType::all();
    }

    #[Computed]
    public function permissions(): stdClass
    {
        $permission         = new stdClass();
        $permission->create = 'vtype_create';
        $permission->read   = 'vtype_read';
        $permission->update = 'vtype_update';
        $permission->delete = 'vtype_delete';

        return $permission;
    }
}
