<?php

namespace App\Livewire\Brand;

use App\Enums\Permission;
use App\Livewire\Forms\BrandForm;
use App\Models\{Brand};
use App\Traits\SortTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Index extends Component
{
    use SortTable;

    public BrandForm $form;

    public string $header = 'Brands';

    public function mount(): void
    {
        $this->setInitialColumn('name');
    }

    #[On('brand::refresh')]
    public function render(): View
    {
        return view('livewire.brand.index', ['permissions' => Permission::class]);
    }

    /** @return array<object> */
    #[Computed()]
    public function table(): array
    {
        return [
            (object)['field' => 'name', 'head' => 'Name'],
            (object)['field' => 'actions', 'head' => 'Actions'],
        ];
    }

    #[Computed]
    public function data(): Collection
    {
        return Brand::orderBy($this->sortColumn, $this->sortDirection)->get();
    }
}
