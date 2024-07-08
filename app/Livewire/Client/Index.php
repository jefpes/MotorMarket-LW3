<?php

namespace App\Livewire\Client;

use App\Models\{Client};
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};
use stdClass;

class Index extends Component
{
    use WithPagination;

    public string $header = 'Clients';

    /** @var array<string> */
    public array $theader = ['Name', 'RG', 'CPF', 'Phone', 'Birth Date', 'Actions'];

    #[Url(except: '', as: 'name', history: true)]
    public ?string $search = '';

    #[On('client::refresh')]
    public function render(): View
    {
        return view('livewire.client.index');
    }

    #[Computed()]
    public function clients(): Paginator
    {
        return Client::when($this->search, fn (Builder $q) => $q->where('name', 'like', "%{$this->search}%"))
                ->paginate();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function permission(): stdClass
    {
        $permission         = new stdClass();
        $permission->create = 'client_create';
        $permission->read   = 'client_read';
        $permission->update = 'client_update';
        $permission->delete = 'client_delete';

        return $permission;
    }
}
