<?php

namespace App\Livewire\Employee;

use App\Enums\{MaritalStatus, States};
use App\Livewire\Forms\{EmployeeAddressForm, EmployeeForm, EmployeePhotoForm};
use App\Models\{City, Employee};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{Storage};
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\{Component, WithFileUploads};

class Update extends Component
{
    use WithFileUploads;
    use Toast;

    public EmployeeForm $employee;

    public EmployeePhotoForm $employeePhoto;

    public EmployeeAddressForm $employeeAddress;

    public string $header = 'Edit Employee';

    /** @var array<Object> */
    public array $photos;

    public function mount(int $id): void
    {
        $employee = Employee::findOrFail($id);
        $this->employee->setEmployee($employee);
        $this->employeeAddress->setAddress($employee);
        $this->employeePhoto->setPhoto($employee);
    }

    public function render(): View
    {
        return view('livewire.employee.update', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases()]);
    }

    private function deleteOldPhotos(Employee $employee): void
    {
        foreach ($employee->photos as $photo) {
            if (Storage::exists("/employee_photos/" . $photo->photo_name)) {
                Storage::delete("/employee_photos/" . $photo->photo_name);
            }
            $photo->delete();
        }
    }

    public function save(): void
    {
        $this->authorize('employee_update');

        file_exists('storage/employee_photos/') ?: Storage::makeDirectory('employee_photos/');

        $this->employee->validate();
        $this->employeeAddress->validate();

        $employee = $this->employee->save();

        // Modifica o email do usuário, se houver
        if($employee->user()->exists() && $employee->user->email !== $this->employee->email) {
            $employee->user->update(['email' => $this->employee->email, 'email_verified_at' => null]);
        }

        // Verifica a data de demissão e desativa o usuário, se houver
        if ($this->employee->resignation_date && $employee->user()->exists()) {
            $employee->user->update(['active' => false]);
        }

        // Salva o endereço do funcionário
        $this->employeeAddress->entity_id = $employee->id;
        $this->employeeAddress->save($employee); // @phpstan-ignore-line

        // Processa e salva as fotos, se houver
        if ($this->photos) {
            // Deleta as fotos antigas
            $this->deleteOldPhotos($employee);

            $manager = new ImageManager(new Driver());

            foreach ($this->photos as $photo) {
                $image = $manager->read($photo->getRealPath())->scale(height: 1240);

                $path       = 'storage/employee_photos/';
                $customName = $path . str_replace(' ', '_', $employee->name) . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();

                $image->save($customName);

                $this->employeePhoto->entity_id  = $employee->id;
                $this->employeePhoto->photo_name = str_replace($path, '', $customName);
                $this->employeePhoto->format     = $photo->getClientOriginalExtension();
                $this->employeePhoto->full_path  = storage_path('app/public/') . str_replace('storage/', '', $customName);
                $this->employeePhoto->path       = $customName;

                $this->employeePhoto->save($employee); // @phpstan-ignore-line
            }
        }

        $this->msg  = 'Employee updated successfully';
        $this->icon = 'icons.success';
        $this->dispatch('show-toast');
        $this->redirectRoute('employee.edit', $employee->id);
    }
}
