<?php

namespace App\Livewire\VehicleModel;

use App\Enums\Permission;
use App\Livewire\Forms\VehicleModelForm;
use App\Models\{Brand, VehicleType};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, Locked, On};
use Livewire\Component;

class Edit extends Component
{
    use Toast;

    public ?VehicleModelForm $form;

    public string $title = 'Edit Vehicle Model';

    #[Locked]
    public int $id;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.vehicle-model.create-update');
    }

    #[Computed()]
    public function brands(): Collection
    {
        return Brand::orderBy('name')->get();
    }

    #[Computed()]
    public function types(): Collection
    {
        return VehicleType::orderBy('name')->get();
    }

    #[On('vmodel::editing')]
    public function editing(int $id): void
    {
        $this->form->setVehicleModel($id);
        $this->modal = true;
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }

    public function save(): void
    {
        $this->authorize(Permission::VEHICLE_MODEL_UPDATE->value);

        $this->dispatch('vmodel::refresh');
        $this->form->save();

        $this->toastSuccess('Vehicle model updated successfully');
        $this->reset('modal');
    }
}
