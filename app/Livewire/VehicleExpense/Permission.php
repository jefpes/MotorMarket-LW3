<?php

namespace App\Livewire\VehicleExpense;

enum Permission: string
{
    case create = 'vexpense_create';
    case read   = 'vexpense_read';
    case update = 'vexpense_update';
    case delete = 'vexpense_delete';
}
