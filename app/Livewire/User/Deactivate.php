<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Deactivate extends Component
{
    use Toast;
    use Utilities;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.user.deactivate');
    }

    #[On('user::deactivating')]
    public function deactivating(int $id): void
    {
        $this->form->setUser($id);
        $this->modal = true;
    }

    public function deactive(): void
    {
        $this->authorize($this->permission_delete);

        $userAction = User::find($this->form->id);

        /** @var User $user */
        $user = auth()->user();

        if ($user->hierarchy($userAction->id)) {
            $userAction->delete();
            $this->toastSuccess('User Deactivate');
            $this->dispatch('user::refresh');
            $this->modal = false;

            return;
        }

        $this->toastFail('You not have permission for this action');
        $this->modal = false;
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }
}
