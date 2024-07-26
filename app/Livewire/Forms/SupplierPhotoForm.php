<?php

namespace App\Livewire\Forms;

use App\Models\SupplierPhoto;

class SupplierPhotoForm extends PhotoForm
{
    protected function getPhotoModel(): SupplierPhoto
    {
        return new SupplierPhoto();
    }

    protected function getEntityField(): string
    {
        return 'supplier_id';
    }

    protected function getDirectory(): string
    {
        return 'supplier_photos/';
    }
}
