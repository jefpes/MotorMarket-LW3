<?php

namespace App\Livewire\Employee;

use App\Livewire\Forms\{EmployeeForm};
use App\Models\{Employee};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\{Locked, On};
use Livewire\Component;

class Delete extends Component
{
    public EmployeeForm $form;

    #[Locked]
    public int $id;

    public bool $modal = false;

    public ?string $icon = 'icons.success';

    public ?string $msg = 'Employee Deleted';

    public ?string $title = 'Deleting Employee';

    public function render(): View
    {
        return view('livewire.employee.delete');
    }

    #[On('data::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setEmployee(Employee::find($id));
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize('employee_delete');
        $data = Employee::find($this->form->id);

        if($data->photos->isNotEmpty()) {
            foreach ($data->photos as $photo) {
                Storage::delete("/employee_photos/" . $photo->photo_name);
            }
        }

        $this->form->destroy();
        $this->modal = false;

        $this->dispatch('data::refresh');

        $this->dispatch('show-toast');
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }
}
