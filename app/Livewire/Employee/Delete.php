<?php

namespace App\Livewire\Employee;

use App\Enums\Permission;
use App\Livewire\Forms\{EmployeeForm};
use App\Models\{Employee};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Locked, On};
use Livewire\Component;

class Delete extends Component
{
    use Toast;

    public EmployeeForm $form;

    #[Locked]
    public int $id;

    public bool $modal = false;

    public ?string $title = 'Dismissing Employee';

    public function render(): View
    {
        return view('livewire.employee.delete', ['permission' => Permission::class]);
    }

    #[On('employee::deleting')]
    public function deleting(int $id): void
    {
        $employee = Employee::find($id);

        if ($employee->company) {
            $this->toastFail('Employee is the CEO, it is not possible to delete him, determine another CEO and try again');

            return;
        }

        $this->form->setEmployee($employee);
        $this->modal = true;

        if ($this->form->employee->resignation_date) {
            $this->msg   = 'Retained Employee';
            $this->title = 'Retaining Employee';
        } else {
            $this->msg   = 'Dismissed Employee';
            $this->title = 'Dismissing Employee';
        }
    }

    public function dismissRetain(bool $dismiss): void
    {
        $this->authorize(Permission::EMPLOYEE_DELETE->value);

        $resignationDate = $dismiss ? now() : null;
        $activeStatus    = $dismiss ? false : true;

        $employee = Employee::with('user')->findOrFail($this->form->id);
        $employee->update(['resignation_date' => $resignationDate]);

        $employee->refresh();

        if ($employee->user) {
            $employee->user->update(['active' => $activeStatus]);
        }

        $this->modal = false;

        $this->dispatch('employee::refresh');
        $this->toastSuccess($this->msg);
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }
}
