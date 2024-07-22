<?php

namespace App\Livewire\VehicleExpense;

use App\Models\{VehicleExpense};
use App\Traits\SortTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};
use stdClass;

class Index extends Component
{
    use WithPagination;
    use SortTable;

    public bool $modal = false;

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 15;

    #[Url(except: '', as: 'plate', history: true)]
    public ?string $plate = '';

    #[Url(except: '', as: 'd-i', history: true)]
    public ?string $date_i = '';

    #[Url(except: '', as: 'd-e', history: true)]
    public ?string $date_e = '';

    #[Url(except: '', as: 'min-v', history: true)]
    public ?string $value_min = null;

    #[Url(except: '', as: 'max-v', history: true)]
    public ?string $value_max = null;

    public ?string $header = 'Expenses';

    #[On('expense::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle-expense.index');
    }

    public function mount(): void
    {
        $this->setInitialColumn('date');
    }

    /** @return array<object> */
    #[Computed()]
    public function table(): array
    {
        return [
            (object)['field' => 'plate', 'head' => 'Plate'],
            (object)['field' => 'value', 'head' => 'Value'],
            (object)['field' => 'description', 'head' => 'Description'],
            (object)['field' => 'date', 'head' => 'Date'],
            (object)['field' => 'name', 'head' => 'By'],
            (object)['field' => 'actions', 'head' => 'Actions'],
        ];
    }

    #[Computed()]
    public function expenses(): LengthAwarePaginator
    {
        return VehicleExpense::join('vehicles', 'vehicle_expenses.vehicle_id', '=', 'vehicles.id')
                ->join('users', 'vehicle_expenses.user_id', '=', 'users.id')
                ->select('vehicle_expenses.*', 'vehicles.plate', 'users.name')
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->when($this->plate, fn (Builder $q) => $q->where('vehicles.plate', 'like', "%$this->plate%"))
                ->when($this->date_i, fn (Builder $q) => $q->where('date', '>=', $this->date_i))
                ->when($this->date_e, fn (Builder $q) => $q->where('date', '<=', $this->date_e))
                ->when($this->value_min, fn (Builder $q) => $q->where('value', '>=', $this->value_min))
                ->when($this->value_max, fn (Builder $q) => $q->where('value', '<=', $this->value_max))
                ->paginate($this->perPage);
    }

    public function resetFilters(): void
    {
        $this->reset(['plate', 'date_i', 'date_e', 'value_min', 'value_max', 'perPage']);
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
