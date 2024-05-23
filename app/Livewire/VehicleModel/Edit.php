<?php

namespace App\Livewire\VehicleModel;

use App\Livewire\Forms\VehicleModelForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Locked, On};
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
        return view('livewire.vehicle-model.edit', [
            'brands' => \App\Models\Brand::orderBy('name')->get(),
        ]);
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

        $this->icon = 'icons.success';

        $this->msg = 'Vehicle Model Updated';

        $this->dispatch('show-toast');
        $this->reset('modal');
    }
}
