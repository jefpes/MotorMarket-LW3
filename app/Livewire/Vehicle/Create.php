<?php

namespace App\Livewire\Vehicle;

use App\Enums\{FuelTypes, Permission, SteeringTypes, TransmissionTypes};
use App\Livewire\Forms\{VehicleForm, VehiclePhotoForm};
use App\Models\{VehicleModel, VehicleType};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed};
use Livewire\{Component, WithFileUploads};

class Create extends Component
{
    use WithFileUploads;
    use Toast;

    public VehicleForm $vehicle;

    public VehiclePhotoForm $vehiclePhoto;

    public string $header = 'Create Vehicle';

    public function render(): View
    {
        return view('livewire.vehicle.create-update', ['fuelTypes' => FuelTypes::cases(), 'steeringTypes' => SteeringTypes::cases(), 'transmissionTypes' => TransmissionTypes::cases()]);
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
        $this->authorize(Permission::VEHICLE_CREATE->value);

        $vehicle = $this->vehicle->save();

        $this->vehiclePhoto->save($vehicle->id, $vehicle->plate);

        $this->vehicle->reset();

        $this->toastSuccess('Vehicle created successfully');
    }
}
