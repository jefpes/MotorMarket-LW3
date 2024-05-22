<?php

namespace App\Livewire\Role;

use App\Livewire\Forms\RoleForm;
use App\Models\Role;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Locked, On};
use Livewire\Component;

class Edit extends Component
{
    use Toast;

    public ?RoleForm $form;

    #[Locked]
    public int $id;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.role.edit');
    }

    #[On('role::editing')]
    public function editing(int $id): void
    {
        $this->form->setRole($id);
        $this->modal = true;
    }

    public function save(): void
    {
        $this->authorize('admin');

        /** @var User */
        $user = auth()->user(); /** @phpstan-ignore-line */

        if ($user->roles()->pluck('hierarchy')->max() > (Role::find($this->form->id)->hierarchy ?? $user->roles()->pluck('hierarchy')->max() + 1)) { /** @phpstan-ignore-line */
            abort(403, 'you not have permission for this action');
        }

        $this->dispatch('role::refresh');
        $this->form->save();

        $this->icon = 'icons.success';

        $this->msg = 'Role Updated';

        $this->dispatch('show-toast');
        $this->reset('modal');
    }
}
