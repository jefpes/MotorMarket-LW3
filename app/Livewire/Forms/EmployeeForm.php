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

    public ?string $gender = null;

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

    public ?string $hiring_date = null;

    public ?string $resignation_date = null;

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name'             => ['required', 'min:3', 'max:255'],
            'gender'           => ['required', 'min:3', 'max:25'],
            'email'            => ['required', 'email', Rule::unique('employees')->ignore($this->id)],
            'phone_one'        => ['required'],
            'phone_two'        => ['nullable'],
            'salary'           => ['nullable', 'numeric'],
            'rg'               => ['required', Rule::unique('employees')->ignore($this->id)],
            'cpf'              => ['required', Rule::unique('employees')->ignore($this->id)],
            'birth_date'       => ['required', 'date'],
            'father'           => ['nullable', 'min:3', 'max:255'],
            'mother'           => ['required', 'min:3', 'max:255'],
            'marital_status'   => ['required', 'min:3', 'max:50'],
            'spouse'           => ['nullable', 'min:3', 'max:255'],
            'hiring_date'      => ['required', 'date'],
            'resignation_date' => ['nullable', 'date'],
        ];
    }

    public function save(): Employee
    {
        $this->validate();

        return Employee::updateOrCreate(
            ['id' => $this->id],
            [
                'name'             => $this->name,
                'gender'           => $this->gender,
                'email'            => $this->email,
                'phone_one'        => $this->phone_one,
                'phone_two'        => $this->phone_two,
                'salary'           => $this->salary,
                'rg'               => $this->rg,
                'cpf'              => $this->cpf,
                'birth_date'       => $this->birth_date,
                'father'           => $this->father,
                'mother'           => $this->mother,
                'marital_status'   => $this->marital_status,
                'spouse'           => $this->spouse,
                'hiring_date'      => $this->hiring_date,
                'resignation_date' => $this->resignation_date,
            ]
        );
    }

    public function setEmployee(Employee $e): void
    {
        $this->fill($e);
        $this->employee = $e;
    }

    public function destroy(): void
    {
        Employee::find($this->id)->delete();
    }
}
