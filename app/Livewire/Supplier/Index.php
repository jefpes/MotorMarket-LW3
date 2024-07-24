<?php

namespace App\Livewire\Supplier;

use App\Enums\Permission;
use App\Models\{Supplier};
use App\Traits\SortTable;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use SortTable;
    use WithPagination;
    use Utilities;

    public string $header = 'Suppliers';

    #[Url(except: '', as: 'name', history: true)]
    public ?string $search = '';

    /** @return array<object> */
    #[Computed()]
    public function table(): array
    {
        return [
            (object)['field' => 'name', 'head' => 'Name'],
            (object)['field' => 'rg', 'head' => 'RG'],
            (object)['field' => 'cpf', 'head' => 'CPF'],
            (object)['field' => 'phone_one', 'head' => 'Phone'],
            (object)['field' => 'birth_date', 'head' => 'Birth Date'],
            (object)['field' => 'actions', 'head' => 'Actions'],
        ];
    }

    public function mount(): void
    {
        $this->setInitialColumn('name');
    }

    #[On('supplier::refresh')]
    public function render(): View
    {
        return view('livewire.supplier.index', ['permission' => Permission::class]);
    }

    #[Computed()]
    public function suppliers(): Paginator
    {
        return Supplier::when($this->search, fn (Builder $q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
}
