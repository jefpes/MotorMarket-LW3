<?php

namespace App\Livewire\Employee;

use App\Enums\{MaritalStatus, States};
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

    public EmployeePhotoForm $employeePhotos;

    public EmployeeAddressForm $employeeAddress;

    public string $header = 'Create Employee';

    /** @var array<Object> */
    public array $photos;

    public function render(): View
    {
        return view('livewire.employee.create', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases()]);
    }

    public function save(): void
    {
        $this->authorize('employee_create');

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
        $this->employeeAddress->save($employee); // @phpstan-ignore-line

        // Processa e salva as fotos, se houver
        $this->employeePhoto->save($employee); // @phpstan-ignore-line

        $this->employee->reset();
        $this->employeeAddress->reset();
        $this->employeePhotos->reset();

        $this->msg  = 'Employee created successfully';
        $this->icon = 'icons.success';
        $this->dispatch('show-toast');
    }
}
