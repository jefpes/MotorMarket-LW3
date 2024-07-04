<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public UserForm $form;

    /** @var array<string> */
    public array $theader = ['Name', 'User', 'Register Number', 'E-Mail', 'Actions'];

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
    public function users(): User|LengthAwarePaginator
    {
        return User::query()->loged()->search($this->search)->paginate($this->perPage);
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
