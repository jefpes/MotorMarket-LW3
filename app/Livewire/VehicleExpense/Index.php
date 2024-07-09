<?php

namespace App\Livewire\VehicleExpense;

use App\Models\{VehicleExpense};
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};
use stdClass;

class Index extends Component
{
    use WithPagination;

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 15;

    #[Url(except: '', as: 'p', history: true)]
    public ?string $plete = '';

    public ?string $date_i = '';

    public ?string $date_f = '';

    public ?string $value_min = null;

    public ?string $value_max = null;

    /** @var array<string> */
    public array $theader = ['Vehicle', 'Value', 'Description', 'Date', 'By', 'Actions'];

    public ?string $header = 'Expenses';

    public function mount(): void
    {
        $this->date_i = now()->subMonth()->format('Y-m-d');
        $this->date_f = now()->format('Y-m-d');
    }

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
        ->orderBy('date', 'desc')
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
