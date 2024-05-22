<?php

namespace App\Livewire\Role;

use App\Livewire\Forms\RoleForm;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Index extends Component
{
    public RoleForm $form;

    /** @var array<String> */
    public array $header = ['name', 'hierarchy', 'actions'];

    #[On('role::refresh')]
    public function render(): View
    {
        return view('livewire.role.index');
    }

    #[Computed()]
    public function roles(): Collection
    {
        return Role::with('abilities')->get();
    }
}
