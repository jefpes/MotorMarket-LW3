<?php

namespace App\Livewire\Role;

use App\Livewire\Forms\RoleForm;
use App\Models\Role;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?RoleForm $form;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.role.create');
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
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
        $this->msg  = 'Role Created';

        $this->dispatch('show-toast');
        $this->cancel();
    }
}
