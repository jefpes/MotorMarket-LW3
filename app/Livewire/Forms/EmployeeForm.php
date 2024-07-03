<?php

namespace App\Livewire\Forms;

use App\Models\{Employee};
use Illuminate\Validation\Rule;
use Livewire\Attributes\{Locked};
use Livewire\Form;

class EmployeeForm extends Form
{
    public ?Employee $employee = null;

    #[Locked]
    public ?int $id = null;

    public ?string $name = null;

    public ?string $email = null;

    public ?string $phone_one = null;

    public ?string $phone_two = null;

    public ?float $salary = null;

    public ?string $rg = null;

    public ?string $cpf = null;

    public ?string $birth_date = null;

    public ?string $father = '';

    public ?string $mother = '';

    public ?string $marital_status = null;

    public ?string $spouse = '';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name'           => ['required', 'min:3', 'max:255'],
            'email'          => ['required', 'email', 'unique:employees,email,', Rule::unique('employees')->ignore($this->employee?->id)],
            'phone_one'      => ['required'],
            'phone_two'      => ['nullable'],
            'salary'         => ['nullable', 'numeric'],
            'rg'             => ['required', 'unique:employees,rg,', Rule::unique('employees')->ignore($this->employee?->id)],
            'cpf'            => ['required', 'unique:employees,cpf,', Rule::unique('employees')->ignore($this->employee?->id)],
            'birth_date'     => ['required', 'date'],
            'father'         => ['nullable', 'min:3', 'max:255'],
            'mother'         => ['required', 'min:3', 'max:255'],
            'marital_status' => ['required', 'min:3', 'max:50'],
            'spouse'         => ['nullable', 'min:3', 'max:255'],
        ];
    }

    public function save(): Employee
    {
        $this->validate();

        $employee = Employee::updateOrCreate(
            ['id' => $this->id],
            [
                'name'           => $this->name,
                'email'          => $this->email,
                'phone_one'      => $this->phone_one,
                'phone_two'      => $this->phone_two,
                'salary'         => $this->salary,
                'rg'             => $this->rg,
                'cpf'            => $this->cpf,
                'birth_date'     => $this->birth_date,
                'father'         => $this->father,
                'mother'         => $this->mother,
                'marital_status' => $this->marital_status,
                'spouse'         => $this->spouse,
            ]
        );

        return $employee;
    }

    public function setEmployee(Employee $e): void
    {
        $this->employee       = $e;
        $this->id             = $this->employee->id;
        $this->name           = $this->employee->name;
        $this->email          = $this->employee->email;
        $this->phone_one      = $this->employee->phone_one;
        $this->phone_two      = $this->employee->phone_two;
        $this->salary         = $this->employee->salary;
        $this->rg             = $this->employee->rg;
        $this->cpf            = $this->employee->cpf;
        $this->birth_date     = $this->employee->birth_date;
        $this->father         = $this->employee->father;
        $this->mother         = $this->employee->mother;
        $this->marital_status = $this->employee->marital_status;
        $this->spouse         = $this->employee->spouse;
    }

    public function destroy(): void
    {
        Employee::find($this->id)->delete();
    }
}
