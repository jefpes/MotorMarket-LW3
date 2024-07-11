<?php

namespace App\Livewire\VehicleModel;

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

    #[Locked]
    public int $id;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.vehicle-model.edit');
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

    public function save(): void
    {
        $this->authorize('vmodel_update');

        $this->dispatch('vmodel::refresh');
        $this->form->save();

        $this->toastSuccess('Vehicle Model updated successfully');
        $this->reset('modal');
    }
}
