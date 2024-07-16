<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;
    use Utilities;

    /** @var array<string> */
    public array $theader = ['name', 'email', 'status', 'actions'];

    #[Url(except: '', as: 's', history: true)]
    public ?string $search = '';

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 10;

    #[On('user::refresh')]
    public function render(): View
    {
        return view('livewire.user.index');
    }

    #[Computed()]
    public function users(): LengthAwarePaginator
    {
        return User::query()->withTrashed()->loged()->search($this->search)->paginate($this->perPage);
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
