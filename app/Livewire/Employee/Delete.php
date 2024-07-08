<?php

namespace App\Livewire\Employee;

use App\Livewire\Forms\{EmployeeForm};
use App\Models\{Employee};
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Locked, On};
use Livewire\Component;

class Delete extends Component
{
    public EmployeeForm $form;

    #[Locked]
    public int $id;

    public bool $modal = false;

    public ?string $icon = 'icons.success';

    public ?string $msg = 'Dismissed Employee';

    public ?string $title = 'Dismissing Employee';

    public function render(): View
    {
        return view('livewire.employee.delete');
    }

    #[On('employee::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setEmployee(Employee::find($id));
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
        $this->authorize('employee_delete');

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
        $this->dispatch('show-toast');
    }

    // public function dismiss(): void
    // {
    //     $this->authorize('employee_delete');

    //     $data = Employee::find($this->form->id)->update(['resignation_date' => now()]);

    //     if($data->user) {
    //         $data->user->update(['active' => false]);
    //     }

    //     $this->modal = false;

    //     $this->dispatch('employee::refresh');

    //     $this->dispatch('show-toast');
    // }

    // public function retain(): void
    // {
    //     $this->authorize('employee_delete');

    //     $data = Employee::find($this->form->id)->update(['resignation_date' => null]);

    //     if($data->user) {
    //         $data->user->update(['active' => true]);
    //     }

    //     $this->modal = false;

    //     $this->dispatch('employee::refresh');

    //     $this->dispatch('show-toast');
    // }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }
}
