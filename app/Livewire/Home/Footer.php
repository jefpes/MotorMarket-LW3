<?php

namespace App\Livewire\Home;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Footer extends Component
{
    public function render(): View
    {
        return view('livewire.home.footer', ['company' => Company::find(1)]);
    }
}
