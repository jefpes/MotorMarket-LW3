<?php

namespace App\Livewire\Employee;

use App\Enums\{Genders, MaritalStatus, States};
use App\Livewire\Forms\{EmployeeAddressForm, EmployeeForm, EmployeePhotoForm};
use App\Models\{City};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\{Component, WithFileUploads};

class Create extends Component
{
    use WithFileUploads;
    use Toast;

    public EmployeeForm $employee;

    public EmployeePhotoForm $employeePhoto;

    public EmployeeAddressForm $employeeAddress;

    public string $header = 'Create Employee';

    public function render(): View
    {
        return view('livewire.employee.create-update', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases(), 'genders' => Genders::cases()]);
    }

    public function save(): void
    {
        $this->authorize('employee_create');

        $this->employee->validate();
        $this->employeeAddress->validate();

        $employee = $this->employee->save();

        // Salva o endereço do funcionário
        $this->employeeAddress->entity_id = $employee->id;
        $this->employeeAddress->save();

        // Processa e salva as fotos, se houver
        $this->employeePhoto->save($employee->id, $employee->name);

        $this->employee->reset();
        $this->employeeAddress->reset();
        $this->employeePhotos->reset(); // @phpstan-ignore-line

        $this->toastSuccess('Employee created successfully');
    }
}
