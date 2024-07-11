<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Employee;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public UserForm $form;

    public bool $modal = false;

    public string $title = 'Create new user';

    public function render(): View
    {
        return view('livewire.user.create', ['employees' => Employee::whereResignationDate(null)->orderBy('name')->get()]);
    }

    public function save(): void
    {
        $this->form->validateOnly('employee_id');
        $employee          = Employee::findOrFail($this->form->employee_id);
        $this->form->name  = $employee->name;
        $this->form->email = $employee->email;
        $this->form->save();

        $this->toastSuccess('User created successfully');
        $this->dispatch('user::refresh');
        $this->form->reset();
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->modal = false;
    }
}
