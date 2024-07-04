<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\{Employee, User};
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component
{
    public UserForm $form;

    public function mount(int $id): void
    {
        $this->form->setUser($id);
    }

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
}
