<?php

namespace App\Livewire\User;

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

    public ?string $icon = 'icons.success';

    public ?string $msg = 'User Activated';

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
        $this->authorize('user_delete');

        $userAction = User::find($this->form->id);

        /** @var User $user */
        $user = auth()->user();

        if ($user->hierarchy($userAction->id)) {
            $userAction->roles()->detach();
            $this->toastSuccess('User Activated');
            $userAction->update(['active' => true]);
            $this->dispatch('user::refresh')->to(Index::class);
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
