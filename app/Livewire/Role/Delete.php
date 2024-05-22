<?php

namespace App\Livewire\Role;

use App\Livewire\Forms\RoleForm;
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
        $this->authorize('admin');

        /** @var User */
        $user = auth()->user(); /** @phpstan-ignore-line */

        if ($user->roles()->pluck('hierarchy')->max() > $this->form->hierarchy || $user->roles()->pluck('name')->contains($this->form->name)) { /** @phpstan-ignore-line */
            abort(403, 'you not have permission for this action');
        }

        try {
            $this->msg  = 'Role Deleted';
            $this->icon = 'icons.success';
            $this->form->destroy();
            $this->dispatch('role::refresh');

            $this->dispatch('show-toast');

            $this->modal = false;
        } catch (\Throwable $th) {
            $this->msg  = 'Role Not Deleted';
            $this->icon = 'icons.fail';

            $this->dispatch('show-toast');

            $this->modal = false;
        }
    }
}
