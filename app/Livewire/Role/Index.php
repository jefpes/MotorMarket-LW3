<?php

namespace App\Livewire\Role;

use App\Enums\Permission;
use App\Livewire\Forms\RoleForm;
use App\Models\Role;
use App\Traits\SortTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Index extends Component
{
    use SortTable;

    public RoleForm $form;

    public function mount(): void
    {
        $this->setInitialColumn('name');
    }

    #[On('role::refresh')]
    public function render(): View
    {
        return view('livewire.role.index', ['permission' => Permission::class]);
    }

    /** @return array<object> */
    #[Computed()]
    public function table(): array
    {
        return [
            (object)['field' => 'name', 'head' => 'Name'],
            (object)['field' => 'hierarchy', 'head' => 'hierarchy'],
            (object)['field' => 'actions', 'head' => 'Actions'],
        ];
    }

    #[Computed()]
    public function roles(): Collection
    {
        return Role::with('abilities')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();
    }
}
