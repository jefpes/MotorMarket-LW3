<?php

namespace App\Livewire\VehicleType;

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

    public function save(): void
    {
        $this->authorize('vtype_update');

        $this->dispatch('vtype::refresh');
        $this->form->save();

        $this->toastSuccess('Vehicle Type updated successfully');
        $this->cancel();
    }

    #[On('vtype::editing')]
    public function editing(int $id): void
    {
        $this->form->setVehicleType($id);

        $this->modal = true;
    }
}
