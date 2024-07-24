<?php

namespace App\Livewire\Supplier;

use App\Enums\Permission;
use App\Models\{Supplier, SupplierPhoto};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
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
        $this->supplier = Supplier::with('photos')->findOrFail($id);
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
        $this->supplierPhoto = SupplierPhoto::findOrFail($id);
        $this->modal         = true;
    }

    public function destroy(): void
    {
        $this->authorize($this->permission_photo_delete);

        try {
            Storage::delete("/supplier_photos/" . $this->supplierPhoto->photo_name);
            $this->supplierPhoto->delete();
            $this->modal = false;

            $this->toastSuccess('Photo Deleted');
        } catch (\Exception $e) {
            $this->modal = false;
            $this->toastFail('Failed to delete photo');
        }
    }

    public function download(): BinaryFileResponse
    {
        $response = null;

        try {
            $response = response()->download($this->supplierPhoto->path, $this->supplierPhoto->photo_name);

            $this->toastSuccess('Photo Downloaded');
        } catch (\Throwable $th) {
            $this->toastFail('Download photo, failed');
        }

        return $response;
    }
}
