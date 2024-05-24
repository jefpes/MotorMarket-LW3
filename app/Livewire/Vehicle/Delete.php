<?php

namespace App\Livewire\Vehicle;

use App\Livewire\Forms\VehicleForm;
use App\Models\Vehicle;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Delete extends Component
{
    use Toast;

    public VehicleForm $form;

    #[Locked]
    public int $id;

    public bool $modal = false;

    public string $title = 'Deleting Vehicle';

    public function render(): View
    {
        return view('livewire.vehicle.delete');
    }

    public function deleting(int $id): void
    {
        $this->form->setVehicle($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize('vehicle_delete');
        $vehicle = Vehicle::find($this->form->id);

        if($vehicle->photos->isNotEmpty()) {
            foreach ($vehicle->photos as $photo) {
                Storage::delete("/vehicle_photos/" . $photo->photo_name);
            }
        }

        $this->icon = 'icons.success';

        $this->msg = 'Vehicle Deleted';

        $this->form->destroy();
        $this->modal = false;

        $this->dispatch('vehicle::refresh');

        $this->dispatch('show-toast');
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }
}
