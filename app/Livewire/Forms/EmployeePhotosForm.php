<?php

namespace App\Livewire\Forms;

use App\Models\{Employee, EmployeePhotos};
use Livewire\Attributes\{Locked};
use Livewire\Form;

class EmployeeAddressForm extends Form
{
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
            'employee_id' => ['required', 'exists:employees,id', 'integer'], // 'exists' => 'Employee,id'
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

    public function setEmployeePhotos(int $id): void
    {
        $photos            = EmployeePhotos::where('employee_id', $id);
        $this->id          = $photos->id; /* @phpstan-ignore-line */
        $this->employee_id = $photos->employee_id; /* @phpstan-ignore-line */
        $this->photo_name  = $photos->photo_name; /* @phpstan-ignore-line */
        $this->format      = $photos->format; /* @phpstan-ignore-line */
        $this->full_path   = $photos->full_path; /* @phpstan-ignore-line */
    }
}
