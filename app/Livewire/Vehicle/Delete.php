<?php

namespace App\Livewire\Vehicle;

use App\Enums\Permission;
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
        return view('livewire.vehicle.delete', ['permission' => Permission::class]);
    }

    public function deleting(int $id): void
    {
        $this->form->setVehicle(Vehicle::findOrFail($id));
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize(Permission::VEHICLE_DELETE->value);
        $vehicle = Vehicle::find($this->form->id);

        if ($vehicle->photos->isNotEmpty()) {
            foreach ($vehicle->photos as $photo) {
                Storage::delete("/vehicle_photos/" . $photo->photo_name);
            }
        }

        $this->form->destroy();
        $this->modal = false;

        $this->dispatch('vehicle::refresh');

        $this->toastSuccess('Vehicle Deleted');
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }
}
