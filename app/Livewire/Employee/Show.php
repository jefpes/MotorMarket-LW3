<?php

namespace App\Livewire\Employee;

use App\Enums\Permission;
use App\Livewire\Forms\EmployeePhotoForm;
use App\Models\{Employee, EmployeePhotos};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Show extends Component
{
    use Toast;

    public bool $modal = false;

    public Employee $employee;

    public EmployeePhotos $photo;

    public EmployeePhotoForm $employeePhotoForm;

    public string $header = 'Showing Employee';

    public function mount(int $id): void
    {
        $this->employee = Employee::with('photos')->findOrFail($id);
    }

    public function render(): View
    {
        return view('livewire.employee.show', ['permission' => Permission::class]);
    }

    public function cancel(): void
    {
        $this->reset('modal');
    }

    public function actions(int $id): void
    {
        $this->photo = EmployeePhotos::findOrFail($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize(Permission::EMPLOYEE_PHOTO_DELETE->value);

        try {
            $this->employeePhotoForm->deletePhoto($this->photo);
            $this->toastSuccess('Photo Deleted');
            $this->modal = false;
        } catch (\Throwable $th) {
            $this->modal = false;
            $this->toastFail('Photo Not Deleted');
        }
    }

    public function download(): BinaryFileResponse
    {
        $response = null;

        try {
            $response = response()->download($this->photo->path, $this->photo->photo_name);

            $this->icon = 'icons.success';
            $this->msg  = 'Photo Downloaded';

            $this->dispatch('show-toast');

        } catch (\Throwable $th) {
            $this->icon = 'icons.fail';
            $this->msg  = 'Download photo, failed';

            $this->dispatch('show-toast');
        }

        return $response;
    }
}
