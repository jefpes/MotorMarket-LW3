<?php

namespace App\Livewire\City;

use App\Enums\Permission;
use App\Livewire\Forms\CityForm;
use App\Models\{City};
use App\Traits\SortTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Index extends Component
{
    use SortTable;

    public CityForm $form;

    public string $header = 'Cities';

    /** @return array<object> */
    #[Computed()]
    public function table(): array
    {
        return [
            (object)['field' => 'name', 'head' => 'name'],
            (object)['field' => 'actions', 'head' => 'Actions'],
        ];
    }

    public function mount(): void
    {
        $this->setInitialColumn('name');
    }

    #[On('city::refresh')]
    public function render(): View
    {
        return view('livewire.city.index', ['permission' => Permission::class]);
    }

    #[Computed]
    public function data(): Collection
    {
        return City::orderBy($this->sortColumn, $this->sortDirection)->get();
    }
}
