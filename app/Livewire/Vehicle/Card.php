<?php

namespace App\Livewire\Vehicle;

use App\Enums\Permission;
use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Card extends Component
{
    public ?Vehicle $vehicle;

    public function mount(Vehicle $vehicle): void
    {
        $this->vehicle->query()
            ->with('photos', 'model', 'expenses')
            ->find($vehicle->id);
    }

    #[On('expense::create')]
    public function render(): View
    {
        return view('livewire.vehicle.card', ['permission' => Permission::class]);
    }
}
