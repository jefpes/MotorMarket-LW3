<?php

namespace App\Livewire\Supplier;

use App\Enums\Permission;
use App\Models\{Supplier, SupplierPhoto};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Show extends Component
{
    use Toast;
    use Utilities;

    public bool $modal = false;

    public string $header = 'Showing Supplier';

    public function mount(int $id): void
    {
        $this->entity = Supplier::with('photos')->findOrFail($id);
    }

    public function render(): View
    {
        return view('livewire.supplier.show', ['permission' => Permission::class]);
    }

    public function cancel(): void
    {
        $this->reset('modal');
    }

    public function actions(int $id): void
    {
        $this->entityPhoto = SupplierPhoto::findOrFail($id);
        $this->modal       = true;
    }

    public function destroy(): void
    {
        $this->authorize($this->permission_photo_delete);

        try {
            $this->entityPhotoForm->deletePhoto($this->entityPhoto);
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
            $response = response()->download($this->entityPhoto->path, $this->entityPhoto->photo_name);

            $this->toastSuccess('Photo Downloaded');
        } catch (\Throwable $th) {
            $this->toastFail('Download photo, failed');
        }

        return $response;
    }
}
