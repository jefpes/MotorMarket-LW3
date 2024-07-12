<?php

namespace App\Livewire\Forms;

use App\Models\ClientAddress;

class ClientAddressForm extends AddressForm
{
    protected function getAddressModel(): ClientAddress
    {
        return new ClientAddress();
    }

    protected function getEntityField(): string
    {
        return 'client_id';
    }
}
