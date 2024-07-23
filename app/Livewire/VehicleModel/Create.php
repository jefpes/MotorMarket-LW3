<?php

namespace App\Livewire\VehicleModel;

use App\Enums\Permission;
use App\Livewire\Forms\VehicleModelForm;
use App\Models\VehicleType;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?VehicleModelForm $form;

    public bool $modal = false;

    public string $title = 'Create Vehicle Model';

    public function render(): View
    {
        return view('livewire.vehicle-model.create-update');
    }

    #[Computed()]
    public function brands(): Collection
    {
        return \App\Models\Brand::orderBy('name')->get();
    }

    #[Computed()]
    public function types(): Collection
    {
        return VehicleType::orderBy('name')->get();
    }

    #[On('vmodel::creating')]
    public function creating(): void
    {
        $this->modal = true;
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }

    public function save(): void
    {
        $this->authorize(Permission::VEHICLE_MODEL_CREATE->value);

        $this->dispatch('vmodel::refresh');
        $this->form->save();

        $this->toastSuccess('Vehicle model created successfully');
        $this->cancel();
    }
}
