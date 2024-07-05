<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Deactivate extends Component
{
    public UserForm $form;

    public bool $modal = false;

    public ?string $icon = 'icons.success';

    public ?string $msg = 'User Deactived';

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
        $this->authorize('user_delete');

        $userAction = User::find($this->form->id);

        /** @var User $user */
        $user = auth()->user();

        if ($user->hierarchy($userAction->id)) {
            $userAction->roles()->detach();
            $this->icon = 'icons.success';
            $this->msg  = 'User Deactivate';
            $this->dispatch('show-toast')->to(self::class);
            $userAction->update(['active' => false]);
            $this->dispatch('user::refresh')->to(Index::class);
            $this->modal = false;

            return;
        }

        $this->msg  = 'You have not permission for deactivating this register';
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
