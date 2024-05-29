<?php

namespace App\Livewire\Sales;

use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    public ?Vehicle $vehicle;

    public string $header = 'New Sale';

    public function mount(int $id): void
    {
        $this->vehicle = Vehicle::query()
            ->with('photos', 'type', 'model')
            ->find($id);
    }

    public function render(): View
    {
        return view('livewire.sales.create');
    }
}
