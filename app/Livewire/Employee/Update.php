<?php

namespace App\Livewire\Employee;

use App\Enums\{MaritalStatus, States};
use App\Livewire\Forms\{EmployeeAddressForm, EmployeeForm, EmployeePhotoForm};
use App\Models\{City, Employee};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\{Component, WithFileUploads};

class Update extends Component
{
    use WithFileUploads;
    use Toast;

    public EmployeeForm $employee;

    public EmployeePhotoForm $employeePhoto;

    public EmployeeAddressForm $employeeAddress;

    public string $header = 'Edit Employee';

    public function mount(int $id): void
    {
        $employee = Employee::findOrFail($id);
        $this->employee->setEmployee($employee);
        $this->employeeAddress->setAddress($employee);
        $this->employeePhoto->setPhoto($employee);
    }

    public function render(): View
    {
        return view('livewire.employee.create-update', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases()]);
    }

    public function save(): void
    {
        $this->authorize('employee_update');

        $this->employee->validate();
        $this->employeeAddress->validate();

        $employee = $this->employee->save();

        // Modifica o email do usuário, se houver
        if($employee->user()->exists() && $employee->user->email !== $this->employee->email) {
            $employee->user->update(['email' => $this->employee->email, 'email_verified_at' => null]);
        }

        // Salva o endereço do funcionário
        $this->employeeAddress->entity_id = $employee->id;
        $this->employeeAddress->save();

        // Remove a foto antiga, se houver
        $this->employeePhoto->deleteOldPhotos($employee);

        // Processa e salva as fotos, se houver
        $this->employeePhoto->save($employee);

        $this->msg  = 'Employee updated successfully';
        $this->icon = 'icons.success';
        $this->dispatch('show-toast');
        $this->redirectRoute('employee.edit', $employee->id);
    }
}
