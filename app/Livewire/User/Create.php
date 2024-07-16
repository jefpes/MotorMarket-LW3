<?php

namespace App\Livewire\User;

use App\Models\Employee;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    use Toast;
    use Utilities;

    public bool $modal = false;

    public string $title = 'Create new user';

    public function render(): View
    {
        return view('livewire.user.create', ['employees' => Employee::whereResignationDate(null)->orderBy('name')->get()]);
    }

    public function save(): void
    {
        $this->authorize($this->permission_create);

        $this->form->validateOnly('employee_id');
        $employee          = Employee::findOrFail($this->form->employee_id);
        $this->form->name  = $employee->name;
        $this->form->email = $employee->email;
        $this->form->save();

        $this->toastSuccess('User created successfully');
        $this->dispatch('user::refresh');
        $this->cancel();
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->modal = false;
    }
}
