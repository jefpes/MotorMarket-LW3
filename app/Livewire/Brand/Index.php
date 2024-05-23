<?php

namespace App\Livewire\Brand;

use App\Livewire\Forms\BrandForm;
use App\Models\{Brand};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;
use stdClass;

class Index extends Component
{
    public BrandForm $form;

    public string $header = 'Brands';

    /** @var array<String> */
    public array $thead = ['Name', 'Actions'];

    #[On('brand::refresh')]
    public function render(): View
    {
        return view('livewire.brand.index');
    }

    #[Computed]
    public function data(): Collection
    {
        return Brand::all();
    }

    #[Computed]
    public function permissions(): stdClass
    {
        $permission         = new stdClass();
        $permission->create = 'brand_create';
        $permission->read   = 'brand_read';
        $permission->update = 'brand_update';
        $permission->delete = 'brand_delete';

        return $permission;
    }
}
