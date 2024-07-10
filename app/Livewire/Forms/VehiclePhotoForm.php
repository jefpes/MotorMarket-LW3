<?php

namespace App\Livewire\Forms;

use App\Models\VehiclePhoto;

class VehiclePhotoForm extends PhotoForm
{
    protected function getPhotoModel(): VehiclePhoto
    {
        return new VehiclePhoto();
    }

    protected function getEntityField(): string
    {
        return 'vehicle_id';
    }

    protected function getDirectory(): string
    {
        return 'vehicle_photos/';
    }
}
