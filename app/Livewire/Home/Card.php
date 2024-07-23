<?php

namespace App\Livewire\Home;

use App\Models\{Vehicle};
use Illuminate\Contracts\View\View;
use Livewire\{Component};

class Card extends Component
{
    public ?Vehicle $v;

    public function mount(Vehicle $vehicle): void
    {
        $this->v = $vehicle;
    }

    public function render(): View
    {
        return view('livewire.home.card');
    }
}
