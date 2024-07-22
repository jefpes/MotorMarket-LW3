<?php

namespace App\Livewire\City;

use App\Enums\Permission;
use App\Livewire\Forms\CityForm;
use App\Models\{City};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Index extends Component
{
    public CityForm $form;

    public string $header = 'Cities';

    /** @var array<String> */
    public array $thead = ['Name', 'Actions'];

    #[On('city::refresh')]
    public function render(): View
    {
        return view('livewire.city.index', ['permission' => Permission::class]);
    }

    #[Computed]
    public function data(): Collection
    {
        return City::orderBy('name')->get();
    }
}
