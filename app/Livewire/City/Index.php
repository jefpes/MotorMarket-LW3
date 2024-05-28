<?php

namespace App\Livewire\City;

use App\Livewire\Forms\CityForm;
use App\Models\{City};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;
use stdClass;

class Index extends Component
{
    public CityForm $form;

    public string $header = 'Cities';

    /** @var array<String> */
    public array $thead = ['Name', 'Actions'];

    #[On('city::refresh')]
    public function render(): View
    {
        return view('livewire.city.index');
    }

    #[Computed]
    public function data(): Collection
    {
        return City::all();
    }

    #[Computed]
    public function permissions(): stdClass
    {
        $permission         = new stdClass();
        $permission->create = 'city_create';
        $permission->read   = 'city_read';
        $permission->update = 'city_update';
        $permission->delete = 'city_delete';

        return $permission;
    }
}
