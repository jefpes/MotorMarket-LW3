<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\{Employee, User};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use Toast;

    public bool $modal = false;

    public string $title = 'Edit user';

    public UserForm $form;

    public function render(): View
    {
        return view('livewire.user.edit', ['employees' => Employee::orderBy('name')->get()]);
    }

    public function save(): void
    {
        $this->authorize('user_update');

        /** @var User  */
        $user = auth()->user();

        if (!$user->hierarchy($this->form->id)) {
            abort(403, 'you not have permission for this action');
        }

        $this->form->save();
        $this->redirectRoute('users', navigate: true);
    }

    #[On('user::editing')]
    public function editing(int $id): void
    {
        $this->form->setUser($id);
        $this->modal = true;
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->modal = false;
    }
}
