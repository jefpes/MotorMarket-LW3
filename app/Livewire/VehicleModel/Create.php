<?php

namespace App\Livewire\VehicleModel;

use App\Livewire\Forms\VehicleModelForm;
use App\Models\VehicleType;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?VehicleModelForm $form;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.vehicle-model.create');
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

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }

    public function save(): void
    {
        $this->authorize('vmodel_create');

        $this->dispatch('vmodel::refresh');
        $this->form->save();

        $this->toastSuccess('Vehicle Model created successfully');
        $this->cancel();
    }
}
