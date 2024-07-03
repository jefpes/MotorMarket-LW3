<?php

namespace App\Livewire\Forms;

use App\Models\{Employee, EmployeeAddress};
use Livewire\Attributes\{Locked};
use Livewire\Form;

class EmployeeAddressForm extends Form
{
    public ?EmployeeAddress $employeeAddress = null;

    #[Locked]
    public ?int $id = null;

    public ?int $employee_id = null;

    public ?string $zip_code = '';

    public ?string $street = '';

    public ?int $number = null;

    public ?string $neighborhood = '';

    public ?string $complement = '';

    public ?int $city_id = null;

    public ?string $state = '';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'employee_id'  => ['required', 'exists:employees,id', 'integer'], // 'exists' => 'Employee,id'
            'zip_code'     => ['required', 'size:9'],
            'street'       => ['required', 'min:3', 'max:255'],
            'number'       => ['required', 'integer'],
            'neighborhood' => ['required', 'min:3', 'max:255'],
            'complement'   => ['nullable', 'min:3', 'max:255'],
            'city_id'      => ['required', 'exists:cities,id', 'integer'],
            'state'        => ['required', 'min:2', 'max:100'],
        ];
    }

    public function save(Employee $employee): void
    {
        $this->validate();
        $employee->address()->updateOrCreate(
            ['id' => $this->id],
            [
                'zip_code'     => $this->zip_code,
                'street'       => $this->street,
                'number'       => $this->number,
                'neighborhood' => $this->neighborhood,
                'complement'   => $this->complement,
                'city_id'      => $this->city_id,
                'state'        => $this->state,
            ]
        );
    }

    public function setEmployeeAddress(EmployeeAddress $employeeAddress): void
    {
        $this->employeeAddress = $employeeAddress;
        $this->id              = $this->employeeAddress->id;
        $this->employee_id     = $this->employeeAddress->employee_id;
        $this->zip_code        = $this->employeeAddress->zip_code;
        $this->street          = $this->employeeAddress->street;
        $this->neighborhood    = $this->employeeAddress->neighborhood;
        $this->number          = $this->employeeAddress->number;
        $this->complement      = $this->employeeAddress->complement;
        $this->city_id         = $this->employeeAddress->city_id;
        $this->state           = $this->employeeAddress->state;
    }
}
