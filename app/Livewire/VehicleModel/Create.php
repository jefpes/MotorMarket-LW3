<?php

namespace App\Livewire\VehicleModel;

use App\Livewire\Forms\VehicleModelForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?VehicleModelForm $form;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.vehicle-model.create', [
            'brands' => \App\Models\Brand::orderBy('name')->get(),
        ]);
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

        $this->icon = 'icons.success';
        $this->msg  = 'Vehicle Model Created';

        $this->dispatch('show-toast');
        $this->cancel();
    }
}
