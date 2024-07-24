<?php

namespace App\Livewire\Supplier;

use App\Enums\Permission;
use App\Livewire\Forms\{SupplierAddressForm, SupplierForm, SupplierPhotoForm};
use App\Models\{Supplier, SupplierPhoto};

trait Utilities
{
    public ?Supplier $supplier;

    public ?SupplierPhoto $supplierPhoto;

    public ?SupplierForm $supplierForm;

    public ?SupplierPhotoForm $supplierPhotoForm;

    public ?SupplierAddressForm $supplierAddressForm;

    public string $permission_create = Permission::CLIENT_CREATE->value;

    public string $permission_read = Permission::CLIENT_READ->value;

    public string $permission_update = Permission::CLIENT_UPDATE->value;

    public string $permission_delete = Permission::CLIENT_DELETE->value;

    public string $permission_photo_delete = Permission::CLIENT_PHOTO_DELETE->value;
}
