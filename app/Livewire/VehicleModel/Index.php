<?php

namespace App\Livewire\VehicleModel;

use App\Livewire\Forms\VehicleModelForm;
use App\Models\{Brand, VehicleModel};
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\Component;

class Index extends Component
{
    public VehicleModelForm $form;

    public string $header = 'Vehicle Models';

    #[Url(except: '', as: 'name', history: true)]
    public ?string $search = '';

    #[Url(except: null, as: 'brand', history: true)]
    public ?int $brand_id = null;

    /** @var array<String> */
    public array $thead = ['name', 'brand', 'actions'];

    #[On('vmodel::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle-model.index', [
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }

    #[Computed()]
    public function vmodels(): Collection
    {
        return VehicleModel::with('brand')
        ->orderBy('name')
        ->when($this->brand_id, fn (Builder $q) => $q->whereHas('brand', function (Builder $q) {
            $q->where('id', $this->brand_id);
        }))
        ->when($this->search, fn (Builder $q) => $q->where('name', 'like', "%{$this->search}%"))
        ->get();
    }
}
