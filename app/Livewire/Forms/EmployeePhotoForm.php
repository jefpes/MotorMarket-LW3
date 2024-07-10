<?php

namespace App\Livewire\Forms;

use App\Models\EmployeePhotos;

class EmployeePhotoForm extends PhotoForm
{
    protected function getPhotoModel(): EmployeePhotos
    {
        return new EmployeePhotos();
    }

    protected function getEntityField(): string
    {
        return 'employee_id';
    }
}
