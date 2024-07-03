<?php

namespace App\Livewire\Employee;

use App\Enums\{MaritalStatus, States};
use App\Livewire\Forms\{EmployeeAddressForm, EmployeeForm, EmployeePhotosForm};
use App\Models\{City};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{DB, Storage};
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\{Component, WithFileUploads};

class Create extends Component
{
    use WithFileUploads;
    use Toast;

    public EmployeeForm $employee;

    public EmployeePhotosForm $employeePhotos;

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
        // dd($this->employee, $this->employeePhotos, $this->employeeAddress);
        $this->authorize('employee_create');

        file_exists('storage/employee_photos/') ?: Storage::makeDirectory('employee_photos/');

        DB::beginTransaction();

        try {
            $employee = $this->employee->save();
            $this->employeeAddress->save($employee);

            if($this->photos) {
                // create image manager with desired driver
                $manager = new ImageManager(new Driver());

                foreach ($this->photos as $photo) {
                    // read image from file system

                    $image = $manager->read($photo);

                    // resize image proportionally to 300px width
                    $image->scale(height: 1240);

                    $path = 'storage/employee_photos/';

                    $customName = $path . str_replace(' ', '_', $employee->name) . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();

                    // Save image
                    $image->save($customName);

                    $this->employeePhotos->employee_id = $employee->id;
                    $this->employeePhotos->photo_name  = str_replace($path, '', $customName);
                    $this->employeePhotos->format      = $photo->getClientOriginalExtension();
                    $this->employeePhotos->full_path   = storage_path('app/public/') . str_replace('storage/', '', $customName);
                    $this->employeePhotos->path        = $customName;

                    $this->employeePhotos->save($employee);
                }
            }

            DB::commit();

            $this->employee->reset();
            $this->employeeAddress->reset();
            $this->employeePhotos->reset();

            $this->msg  = 'Employee created successfully';
            $this->icon = 'icons.success';
            $this->dispatch('show-toast');
        } catch(\Exception $e) {
            DB::rollBack();

            return;
        }
    }
}
