<?php

namespace App\Livewire\Client;

use App\Enums\Permission;
use App\Models\{Client};
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

    public string $header = 'Clients';

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

    #[On('client::refresh')]
    public function render(): View
    {
        return view('livewire.client.index', ['permission' => Permission::class]);
    }

    public function deleting(int $id): void
    {
        $this->dispatch('client::deleting', $id);
    }

    #[Computed()]
    public function clients(): Paginator
    {
        return Client::when($this->search, fn (Builder $q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
}
