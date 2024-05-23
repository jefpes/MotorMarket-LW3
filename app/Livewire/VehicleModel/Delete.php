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
            $this->msg  = 'Vehicle Model Deleted';
            $this->icon = 'icons.success';
            $this->form->destroy();
            $this->dispatch('vmodel::refresh');

            $this->dispatch('show-toast');

            $this->modal = false;
        } catch (\Throwable $th) {
            $this->msg  = 'Vehicle Model Not Deleted';
            $this->icon = 'icons.fail';

            $this->dispatch('show-toast');

            $this->modal = false;
        }
    }
}
