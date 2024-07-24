<?php

namespace App\Livewire\Forms;

use App\Models\SupplierAddress;

class SupplierAddressForm extends AddressForm
{
    protected function getAddressModel(): SupplierAddress
    {
        return new SupplierAddress();
    }

    protected function getEntityField(): string
    {
        return 'supplier_id';
    }
}
