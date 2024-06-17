<?php

namespace App\Livewire\Home;

use App\Models\{Brand, Vehicle};
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, Layout};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public bool $modal = false;

    /** @var array<int> */
    public ?array $selectedBrands = [];

    public ?string $year_ini = '';

    public ?string $year_end = '';

    public ?string $order = 'asc';

    public function mount(): void
    {
        $this->year_ini       = Vehicle::min('year_one');
        $this->year_end       = date('Y');
        $this->selectedBrands = Brand::all()->pluck('id')->toArray(); /* @phpstan-ignore-line */
    }

    #[Layout('components.layouts.home')]
    public function render(): View
    {
        return view('livewire.home.index', ['brands' => Brand::all()]);
    }

    #[Computed()]
    public function vehicles(): LengthAwarePaginator
    {
        return Vehicle::with('type', 'model', 'photos')
            ->orderBy('updated_at', 'desc')
            ->where('sold_date', '=', null)
            ->when(count($this->selectedBrands), fn ($query) => $query->whereHas('model', fn ($query) => $query->whereIn('brand_id', $this->selectedBrands)))
            ->when($this->year_ini && $this->year_end, fn ($query) => $query->whereBetween('year_one', [$this->year_ini, $this->year_end]))
            ->when($this->order, fn ($query) => $query->orderBy('sale_price', $this->order))
            ->paginate();
    }
}
