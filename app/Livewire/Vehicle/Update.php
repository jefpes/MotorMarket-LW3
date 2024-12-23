<?php

namespace App\Livewire\Vehicle;

use App\Enums\{FuelTypes, SteeringTypes, TransmissionTypes};
use App\Livewire\Forms\{VehicleForm, VehiclePhotoForm};
use App\Models\Supplier;
use App\Models\{Vehicle, VehicleModel, VehicleType};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    use Toast;

    public VehicleForm $vehicle;

    public VehiclePhotoForm $vehiclePhoto;

    public string $header = 'Editing Vehicle';

    public function mount(int $id): void
    {
        $this->vehicle->setVehicle(Vehicle::findOrFail($id));
    }

    public function render(): View
    {
        return view('livewire.vehicle.create-update', ['fuelTypes' => FuelTypes::cases(), 'steeringTypes' => SteeringTypes::cases(), 'transmissionTypes' => TransmissionTypes::cases()]);
    }

    #[Computed()]
    public function suppliers(): Collection
    {
        return Supplier::orderBy('name')->get();
    }

    #[Computed()]
    public function models(): Collection
    {
        return VehicleModel::orderBy('name')->get();
    }

    #[Computed()]
    public function types(): Collection
    {
        return VehicleType::orderBy('name')->get();
    }

    public function save(): void
    {
        $this->authorize('vehicle_update');

        $vehicle = $this->vehicle->save();

        $this->vehiclePhoto->save($vehicle->id, $vehicle->plate);

        $this->toastSuccess('Vehicle updated successfully');
    }
}
