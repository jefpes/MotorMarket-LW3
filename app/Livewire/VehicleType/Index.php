<?php

namespace App\Livewire\VehicleType;

use App\Enums\Permission;
use App\Livewire\Forms\VehicleTypeForm;
use App\Models\{VehicleType};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Index extends Component
{
    public VehicleTypeForm $form;

    public string $header = 'Vehicle Types';

    /** @var array<String> */
    public array $thead = ['Name', 'Actions'];

    #[On('vtype::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle-type.index', ['permission' => Permission::class]);
    }

    #[Computed]
    public function data(): Collection
    {
        return VehicleType::all();
    }
}
