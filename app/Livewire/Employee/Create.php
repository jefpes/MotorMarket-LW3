<?php

namespace App\Livewire\Employee;

use App\Enums\{MaritalStatus, States};
use App\Livewire\Forms\{EmployeeAddressForm, EmployeeForm, EmployeePhotoForm};
use App\Models\{City};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{Storage};
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
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

        file_exists('storage/employee_photos/') ?: Storage::makeDirectory('employee_photos/');

        $this->employee->validate();
        $this->employeeAddress->validate();

        $employee = $this->employee->save();

        // Salva o endereço do funcionário
        $this->employeeAddress->entity_id = $employee->id;
        $this->employeeAddress->save($employee); // @phpstan-ignore-line

        // Processa e salva as fotos, se houver
        if ($this->photos) {
            $manager = new ImageManager(new Driver());

            foreach ($this->photos as $photo) {
                $image = $manager->read($photo);
                $image->scale(height: 1240);

                $path       = 'storage/employee_photos/';
                $customName = $path . str_replace(' ', '_', $employee->name) . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();

                $image->save($customName);

                $this->employeePhotos->entity_id  = $employee->id;
                $this->employeePhotos->photo_name = str_replace($path, '', $customName);
                $this->employeePhotos->format     = $photo->getClientOriginalExtension();
                $this->employeePhotos->full_path  = storage_path('app/public/') . str_replace('storage/', '', $customName);
                $this->employeePhotos->path       = $customName;

                $this->employeePhotos->save($employee); // @phpstan-ignore-line
            }
        }

        $this->employee->reset();
        $this->employeeAddress->reset();
        $this->employeePhotos->reset();

        $this->msg  = 'Employee created successfully';
        $this->icon = 'icons.success';
        $this->dispatch('show-toast');
    }
}
