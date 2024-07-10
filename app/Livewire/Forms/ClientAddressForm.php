<?php

namespace App\Livewire\Forms;

use App\Models\ClientAddress;
use Livewire\Form;

class ClientAddressForm extends Form
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
