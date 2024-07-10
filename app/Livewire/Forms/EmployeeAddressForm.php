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

    public function setEmployeeAddress(Employee $employee): void
    {
        $this->fill(EmployeeAddress::where('employee_id', $employee->id)->first());
    }
}
