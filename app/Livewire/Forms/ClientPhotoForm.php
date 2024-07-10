<?php

namespace App\Livewire\Forms;

use App\Models\ClientPhoto;

class ClientPhotoForm extends PhotoForm
{
    protected function getPhotoModel(): ClientPhoto
    {
        return new ClientPhoto();
    }

    protected function getEntityField(): string
    {
        return 'client_id';
    }

    protected function getDirectory(): string
    {
        return 'client_photos/';
    }
}
