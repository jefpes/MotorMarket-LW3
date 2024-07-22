<?php

namespace App\Livewire\VehicleType;

use App\Enums\Permission;
use App\Livewire\Forms\VehicleTypeForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Update extends Component
{
    use Toast;

    public ?VehicleTypeForm $form;

    public bool $modal = false;

    public ?string $title = 'Edit Vehicle Type';

    public function render(): View
    {
        return view('livewire.vehicle-type.update');
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }

    #[On('vtype::editing')]
    public function editing(int $id): void
    {
        $this->authorize(Permission::VEHICLE_TYPE_UPDATE->value);

        $this->form->setVehicleType($id);

        $this->modal = true;
    }

    public function save(): void
    {
        $this->authorize(Permission::VEHICLE_TYPE_UPDATE->value);

        $this->dispatch('vtype::refresh');
        $this->form->save();

        $this->toastSuccess('Vehicle Type updated successfully');
        $this->cancel();
    }
}
