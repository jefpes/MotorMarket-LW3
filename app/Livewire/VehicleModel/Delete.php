<?php

namespace App\Livewire\VehicleModel;

use App\Livewire\Forms\VehicleModelForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Delete extends Component
{
    use Toast;

    public ?VehicleModelForm $form;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.vehicle-model.delete');
    }

    #[On('vmodel::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setVehicleModel($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize('vmodel_delete');

        try {
            $this->form->destroy();
            $this->toastSuccess('Vehicle Model Deleted');
            $this->dispatch('vmodel::refresh');

            $this->modal = false;
        } catch (\Throwable $th) {
            $this->toastFail('Vehicle Model not deleted');

            $this->modal = false;
        }
    }
}
