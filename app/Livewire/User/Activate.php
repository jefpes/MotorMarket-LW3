<?php

namespace App\Livewire\User;

use App\Enums\Permission;
use App\Livewire\Forms\UserForm;
use App\Models\User;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Activate extends Component
{
    use Toast;

    public UserForm $form;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.user.activate');
    }

    #[On('user::activating')]
    public function activating(int $id): void
    {
        $this->form->setUser($id);
        $this->modal = true;
    }

    public function active(): void
    {
        $this->authorize(Permission::USER_DELETE->value);

        $userAction = User::withTrashed()->find($this->form->id);

        /** @var User $user */
        $user = auth()->user();

        if ($user->hierarchy($userAction->id)) {

            $userAction->restore();

            $this->dispatch('user::refresh')->to(Index::class);

            $this->toastSuccess('User activated');

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
