<?php

namespace App\Livewire\Client;

use App\Enums\Permission;
use App\Livewire\Forms\{ClientAddressForm, ClientForm, ClientPhotoForm};
use App\Models\{Client, ClientPhoto};

trait Utilities
{
    public ?Client $entity;

    public ?ClientPhoto $entityPhoto;

    public ?ClientForm $entityForm;

    public ?ClientPhotoForm $entityPhotoForm;

    public ?ClientAddressForm $entityAddressForm;

    public string $permission_create = Permission::CLIENT_CREATE->value;

    public string $permission_read = Permission::CLIENT_READ->value;

    public string $permission_update = Permission::CLIENT_UPDATE->value;

    public string $permission_delete = Permission::CLIENT_DELETE->value;

    public string $permission_photo_delete = Permission::CLIENT_PHOTO_DELETE->value;
}
