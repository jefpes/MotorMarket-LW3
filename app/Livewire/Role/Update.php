<?php

namespace App\Livewire\Role;

use App\Enums\Permission;
use App\Livewire\Forms\RoleForm;
use App\Models\{Role, User};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Locked, On};
use Livewire\Component;

class Update extends Component
{
    use Toast;

    public ?RoleForm $form;

    #[Locked]
    public int $id;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.role.update');
    }

    #[On('role::editing')]
    public function editing(int $id): void
    {
        $this->form->setRole($id);
        $this->modal = true;
    }

    public function save(): void
    {
        $this->authorize(Permission::ADMIN->value);

        $user = User::find(auth()->id());

        if ($user->roles()->pluck('hierarchy')->max() > (Role::find($this->form->id)->hierarchy ?? $user->roles()->pluck('hierarchy')->max() + 1)) {
            abort(403, 'you not have permission for this action');
        }

        $this->dispatch('role::refresh');
        $this->form->save();

        $this->toastSuccess('Role updated successfully');
        $this->reset('modal');
    }
}
