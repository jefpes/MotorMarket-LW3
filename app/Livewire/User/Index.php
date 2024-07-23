<?php

namespace App\Livewire\User;

use App\Enums\Permission;
use App\Models\User;
use App\Traits\SortTable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;
    use SortTable;

    #[Url(except: '', as: 's', history: true)]
    public ?string $search = '';

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 10;

    /** @return array<object> */
    #[Computed()]
    public function table(): array
    {
        return [
            (object)['field' => 'name', 'head' => 'Name'],
            (object)['field' => 'email', 'head' => 'E-mail'],
            (object)['field' => 'deleted_at', 'head' => 'Status'],
            (object)['field' => 'actions', 'head' => 'Actions'],
        ];
    }

    public function mount(): void
    {
        $this->setInitialColumn('name');
    }

    #[On('user::refresh')]
    public function render(): View
    {
        return view('livewire.user.index', ['permission' => Permission::class]);
    }

    #[Computed()]
    public function users(): LengthAwarePaginator
    {
        return User::query()
                ->withTrashed()
                ->loged()
                ->search($this->search)
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($this->perPage);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
    public function updatedPerPage(): void
    {
        $this->resetPage();
    }
}
