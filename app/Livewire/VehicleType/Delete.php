<?php

namespace App\Livewire\VehicleType;

use App\Livewire\Forms\VehicleTypeForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    use Toast;

    public ?VehicleTypeForm $form;

    public bool $modal = false;

    public ?string $title = 'Deleting Vehicle Type';

    public function render(): View
    {
        return view('livewire.vehicle-type.delete');
    }

    #[On('vtype::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setVehicleType($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize('vtype_delete');

        try {
            $this->form->destroy();
            $this->dispatch('vtype::refresh');

            $this->icon = 'icons.success';
            $this->msg  = 'Vehicle Type Deleted';
            $this->dispatch('show-toast');

            $this->cancel();
        } catch (\Throwable $th) {
            $this->msg  = 'Vehicle Type Not Deleted';
            $this->icon = 'icons.fail';

            $this->dispatch('show-toast');

            $this->cancel();
        }
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }
}
