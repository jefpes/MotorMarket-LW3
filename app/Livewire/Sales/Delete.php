<?php

namespace App\Livewire\Sales;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Delete extends Component
{
    public function render(): View
    {
        return view('livewire.sales.delete');
    }
}