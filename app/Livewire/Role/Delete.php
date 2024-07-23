<?php

namespace App\Livewire\Role;

use App\Enums\Permission;
use App\Livewire\Forms\RoleForm;
use App\Models\User;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Delete extends Component
{
    use Toast;

    public ?RoleForm $form;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.role.delete');
    }

    #[On('role::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setRole($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize(Permission::ADMIN->value);

        $user = User::find(auth()->id());

        if ($user->roles()->pluck('hierarchy')->max() > $this->form->hierarchy || $user->roles()->where('name', $this->form->name)->exists()) {
            abort(403, 'you not have permission for this action');
        }

        try {
            $this->form->destroy();
            $this->dispatch('role::refresh');
            $this->toastSuccess('Role Deleted');

            $this->modal = false;
        } catch (\Throwable $th) {
            $this->toastFail('Role not deleted');

            $this->modal = false;
        }
    }
}
