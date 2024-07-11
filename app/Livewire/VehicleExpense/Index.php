<?php

namespace App\Livewire\VehicleExpense;

use App\Models\{VehicleExpense};
use App\Traits\SortTable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};
use stdClass;

class Index extends Component
{
    use WithPagination;
    use SortTable;

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 15;

    #[Url(except: '', as: 'p', history: true)]
    public ?string $plate = '';

    public ?string $date_i = '';

    public ?string $date_f = '';

    public ?string $value_min = null;

    public ?string $value_max = null;

    /** @var array<string> */
    public array $theader = ['plate', 'value', 'description', 'date', 'by', 'actions'];

    public ?string $header = 'Expenses';

    #[On('expense::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle-expense.index');
    }

    #[Computed()]
    public function expenses(): LengthAwarePaginator
    {
        return  VehicleExpense::query()
        ->with('vehicle', 'user')
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->when($this->plate, fn (Builder $q) => $q->whereHas('vehicle', fn (Builder $q) => $q->where('plate', 'like', "%$this->plate%")))
        ->when($this->date_i, fn (Builder $q) => $q->where('date', '>=', $this->date_i))
        ->when($this->date_f, fn (Builder $q) => $q->where('date', '<=', $this->date_f))
        ->when($this->value_min, fn (Builder $q) => $q->where('value', '>=', $this->value_min))
        ->when($this->value_max, fn (Builder $q) => $q->where('value', '<=', $this->value_max))
        ->paginate($this->perPage);
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function updatedDateI(): void
    {
        $this->resetPage();
    }

    public function updatedDateF(): void
    {
        $this->resetPage();
    }

    public function updatedValueMin(): void
    {
        $this->resetPage();
    }

    public function updatedValueMax(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function permission(): stdClass
    {
        $permission         = new stdClass();
        $permission->create = 'vexpense_create';
        $permission->read   = 'vexpense_read';
        $permission->update = 'vexpense_update';
        $permission->delete = 'vexpense_delete';

        return $permission;
    }
}
