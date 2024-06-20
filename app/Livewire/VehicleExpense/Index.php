<?php

namespace App\Livewire\VehicleExpense;

use App\Models\{VehicleExpense};
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 15;

    #[Url(except: '', as: 'p', history: true)]
    public ?string $plete = '';

    public ?string $date_i = '';

    public ?string $date_f = '';

    /** @var array<string> */
    public array $theader = ['Vehicle', 'Value', 'Description', 'Date', 'By', 'Actions'];

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
        ->orderBy('date', 'desc')
        ->when($this->date_i && $this->date_f, fn (Builder $q) => $q->whereBetween('date', [$this->date_i, $this->date_f]))
        ->paginate($this->perPage);
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }
}
