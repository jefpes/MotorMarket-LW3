<?php

namespace App\Livewire\Forms;

use App\Models\{Employees};
use Livewire\Attributes\{Locked};
use Livewire\Form;

class EmployeeForm extends Form
{
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
            'email'          => ['required', 'email', 'unique:employees,email,' . $this->id],
            'phone_one'      => ['required'],
            'phone_two'      => ['nullable'],
            'salary'         => ['nullable', 'numeric'],
            'rg'             => ['required', 'unique:employees,rg,' . $this->id],
            'cpf'            => ['required', 'unique:employees,cpf,' . $this->id],
            'birth_date'     => ['required', 'date'],
            'father'         => ['nullable', 'min:3', 'max:255'],
            'mother'         => ['required', 'min:3', 'max:255'],
            'marital_status' => ['required', 'min:3', 'max:50'],
            'spouse'         => ['nullable', 'min:3', 'max:255'],
        ];
    }

    public function save(): Employees
    {
        $this->validate();
        $employee = Employees::updateOrCreate(
            ['id' => $this->id],
            [
                'name'           => $this->name,
                'rg'             => $this->rg,
                'cpf'            => $this->cpf,
                'marital_status' => $this->marital_status,
                'phone_one'      => $this->phone_one,
                'phone_two'      => $this->phone_two,
                'birth_date'     => $this->birth_date,
                'father'         => $this->father,
                'mother'         => $this->mother,
            ]
        );

        return $employee;
    }

    public function setClient(int $id): void
    {
        $employee             = Employees::find($id);
        $this->id             = $employee->id;
        $this->name           = $employee->name;
        $this->email          = $employee->email;
        $this->phone_one      = $employee->phone_one;
        $this->phone_two      = $employee->phone_two;
        $this->salary         = $employee->salary;
        $this->rg             = $employee->rg;
        $this->cpf            = $employee->cpf;
        $this->birth_date     = $employee->birth_date;
        $this->father         = $employee->father;
        $this->mother         = $employee->mother;
        $this->marital_status = $employee->marital_status;
        $this->spouse         = $employee->spouse;
    }

    public function destroy(): void
    {
        Employees::find($this->id)->delete();
    }
}
