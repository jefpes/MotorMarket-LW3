<?php

namespace App\Livewire\Forms;

use App\Models\{EmployeeAddress};

class EmployeeAddressForm extends AddressForm
{
    protected function getAddressModel(): EmployeeAddress
    {
        return new EmployeeAddress();
    }

    protected function getEntityField(): string
    {
        return 'employee_id';
    }
}
