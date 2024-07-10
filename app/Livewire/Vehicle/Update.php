<?php

namespace App\Livewire\Vehicle;

use App\Enums\FuelType;
use App\Livewire\Forms\{VehicleForm, VehiclePhotoForm};
use App\Models\{Vehicle, VehicleModel, VehicleType};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    use Toast;

    public VehicleForm $vehicle;

    public VehiclePhotoForm $vechiclePhoto;

    public string $header = 'Editing Vehicle';

    public function mount(int $id): void
    {
        $this->vehicle->setVehicle($id);
        $this->vechiclePhoto->setPhoto(Vehicle::findOrFail($id));
    }
    public function render(): View
    {
        return view('livewire.vehicle.create-update', ['fuelTypes' => FuelType::cases()]);
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

        file_exists('storage/vehicle_photos/') ?: Storage::makeDirectory('vehicle_photos/');

        $vehicle = $this->vehicle->save();

        // create image manager with desired driver
        $manager = new ImageManager(new Driver());

        foreach ($this->vechiclePhoto->photos as $photo) {
            // read image from file system
            $image = $manager->read($photo);

            // resize image proportionally to 300px width
            $image->scale(height: 1240);

            $path       = 'storage/vehicle_photos/';
            $customName = $path . str_replace(' ', '_', $vehicle->plate) . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();

            // Save image
            $image->save($customName);

            $vehicle->photos()->create([
                'photo_name' => str_replace($path, '', $customName),
                'format'     => $photo->getClientOriginalExtension(),
                'full_path'  => storage_path('app/vehicle_photos/') . str_replace('storage/', '', $customName),
                'path'       => $customName,
            ]);
        }

        $this->msg  = 'Vehicle updated successfully';
        $this->icon = 'icons.success';
        $this->dispatch('show-toast');

    }
}
