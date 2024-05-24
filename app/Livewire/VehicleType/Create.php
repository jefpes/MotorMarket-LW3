<?php

namespace App\Livewire\VehicleType;

use App\Livewire\Forms\VehicleTypeForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?VehicleTypeForm $form;

    public bool $modal = false;

    public ?string $title = 'Create New Vehicle Type';

    public function render(): View
    {
        return view('livewire.vehicle-type.create');
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }

    public function save(): void
    {
        $this->authorize('vtype_create');

        $this->dispatch('vtype::refresh');
        $this->form->save();

        $this->icon = 'icons.success';
        $this->msg  = 'Vehicle Type Created';
        $this->dispatch('show-toast');
        $this->cancel();
    }
}
