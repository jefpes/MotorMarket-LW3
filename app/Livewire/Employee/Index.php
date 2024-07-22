<?php

namespace App\Livewire\Employee;

use App\Enums\Permission;
use App\Models\{Employee};
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public string $header = 'Employees';

    /** @var array<string> */
    public array $theader = ['Name', 'RG', 'CPF', 'Phone', 'Birth Date', 'Actions'];

    #[Url(except: '', as: 'name', history: true)]
    public ?string $search = '';

    #[On('employee::refresh')]
    public function render(): View
    {
        return view('livewire.employee.index', ['permission' => Permission::class]);
    }

    #[Computed()]
    public function employees(): Paginator
    {
        return Employee::when($this->search, fn (Builder $q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orderBy('name')
                ->paginate();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
}
