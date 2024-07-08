<?php

namespace App\Livewire\Forms;

use App\Models\{Employee, EmployeePhotos};
use Livewire\Attributes\{Locked};
use Livewire\Form;

class EmployeePhotosForm extends Form
{
    public ?EmployeePhotos $employeePhotos = null;

    #[Locked]
    public ?int $id = null;

    public ?int $employee_id = null;

    public ?string $photo_name = '';

    public ?string $format = '';

    public ?string $full_path = '';

    public ?string $path = '';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'employee_id' => ['required', 'exists:employees,id', 'integer'], // 'exists' => 'employees,id'
            'photo_name'  => ['required', 'min:3', 'max:255'],
            'format'      => ['required', 'max:255'],
            'full_path'   => ['required', 'min:3', 'max:255'],
            'path'        => ['required', 'min:3', 'max:255'],
        ];
    }

    public function save(Employee $employee): void
    {
        $this->validate();
        $employee->photos()->updateOrCreate(
            ['id' => $this->id],
            [
                'photo_name' => $this->photo_name,
                'format'     => $this->format,
                'full_path'  => $this->full_path,
                'path'       => $this->path,
            ]
        );
    }

    public function setEmployeePhotos(Employee $ep): void
    {
        $this->employeePhotos = $ep->photos()->first();
        $this->id             = $this->employeePhotos->id;
        $this->employee_id    = $this->employeePhotos->employee_id;
        $this->photo_name     = $this->employeePhotos->photo_name;
        $this->format         = $this->employeePhotos->format;
        $this->full_path      = $this->employeePhotos->full_path;
    }
}
