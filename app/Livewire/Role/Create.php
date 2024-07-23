<?php

namespace App\Livewire\Role;

use App\Enums\Permission;
use App\Livewire\Forms\RoleForm;
use App\Models\{Role, User};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?RoleForm $form;

    public bool $modal = false;

    public ?string $title = 'Create Role';

    public function render(): View
    {
        return view('livewire.role.create-update');
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }

    #[On('role::creating')]
    public function creating(): void
    {
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

        $this->toastSuccess('Role created successfully');
        $this->cancel();
    }
}
