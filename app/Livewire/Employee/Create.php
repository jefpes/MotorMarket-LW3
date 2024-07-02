<?php

namespace App\Livewire\Employee;

use App\Enums\{MaritalStatus, States};
use App\Livewire\Forms\EmployeeForm;
use App\Models\{City, EmployeeAddress, EmployeePhotos};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\{Component, WithFileUploads};

class Create extends Component
{
    use WithFileUploads;
    use Toast;

    public EmployeeForm $employee;

    public EmployeePhotos $employeePhotos;

    public EmployeeAddress $employeeAddress;

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

        $employee = $this->employee->save();

        // create image manager with desired driver
        $manager = new ImageManager(new Driver());

        foreach ($this->photos as $photo) {
            // read image from file system

            $image = $manager->read($photo);

            // resize image proportionally to 300px width
            $image->scale(height: 1240);

            $path       = 'storage/employee_photos/';
            $customName = $path . str_replace(' ', '_', $employee->name) . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();

            // Save image
            $image->save($customName);

            $employee->photos()->create([
                'photo_name' => str_replace($path, '', $customName),
                'format'     => $photo->getClientOriginalExtension(),
                'full_path'  => storage_path('app/public/') . str_replace('storage/', '', $customName),
                'path'       => $customName,
            ]);
        }
        $this->employee->reset();

        $this->msg  = 'Employee created successfully';
        $this->icon = 'icons.success';
        $this->dispatch('show-toast');
    }
}
