<?php

namespace App\Livewire\User;

use App\Enums\Permission;
use App\Livewire\Forms\UserForm;
use App\Models\{Employee, User};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use Toast;

    public UserForm $form;

    public bool $modal = false;

    public string $title = 'Edit user';

    public function render(): View
    {
        return view('livewire.user.edit', ['employees' => Employee::whereResignationDate(null)->orderBy('name')->get()]);
    }

    public function save(): void
    {
        $this->authorize(Permission::USER_UPDATE->value);

        /** @var User  */
        $user = auth()->user();

        if (!$user->hierarchy($this->form->id)) {
            abort(403, 'you not have permission for this action');
        }

        $employee = Employee::findOrFail($this->form->employee_id);

        $this->form->name  = $employee->name;
        $this->form->email = $employee->email;

        $this->form->validate();
        User::findOrFail($this->form->id)->update(
            [
                'name'              => $this->form->name,
                'email'             => $this->form->email,
                'employee_id'       => $this->form->employee_id,
                'email_verified_at' => null,
            ]
        );

        $this->toastSuccess('User updated successfully');
        $this->dispatch('user::refresh');
        $this->cancel();
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
