<?php

namespace App\Livewire\Vehicle;

use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Card extends Component
{
    public Vehicle $vehicle;

    public function mount(Vehicle $vehicle): void
    {
        $this->vehicle = $vehicle->with('photos', 'model', 'type')->find($vehicle->id);
    }

    public function render(): View
    {
        return view('livewire.vehicle.card');
    }
}
