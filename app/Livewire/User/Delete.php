<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Delete extends Component
{
    public UserForm $form;

    public bool $modal = false;

    public ?string $icon = 'icons.success';

    public ?string $msg = 'User Deleted';

    public function render(): View
    {
        return view('livewire.user.delete');
    }

    #[On('user::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setUser($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize('user_delete');

        $userDeleting = User::find($this->form->id);

        /** @var User $user */
        $user = auth()->user();

        if ($user->hierarchy($userDeleting->id)) {
            $userDeleting->roles()->detach();
            $this->icon = 'icons.success';
            $this->msg  = 'User Deleted';
            $this->dispatch('show-toast')->to(self::class);
            $this->form->destroy();
            $this->dispatch('user::deleted')->to(Index::class);
            $this->modal = false;

            return;
        }

        $this->msg  = 'You have not permission for deletion this register';
        $this->icon = 'icons.fail';

        $this->dispatch('show::toast');
        $this->modal = false;
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }
}
