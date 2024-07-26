<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Locked, On};
use Livewire\Component;

class Delete extends Component
{
    use Toast;
    use Utilities;

    #[Locked]
    public int $id;

    public bool $modal = false;

    public ?string $title = 'Deleting Supplier';

    public function render(): View
    {
        return view('livewire.supplier.delete');
    }

    #[On('supplier::deleting')]
    public function deleting(int $id): void
    {
        $this->entityForm->setSupplier(Supplier::find($id));
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize($this->permission_delete);

        $supplier = Supplier::find($this->entityForm->id);

        try {
            $this->entityForm->destroy();
            $this->entityPhotoForm->deleteOldPhotos($supplier);
            $this->entityForm->reset();
            $this->modal = false;
            $this->dispatch('supplier::refresh');
            $this->toastSuccess('Supplier Deleted');

        } catch (\Exception $e) {
            $this->toastFail('Supplier Not Deleted');
            $this->modal = false;
        }
    }

    public function cancel(): void
    {
        $this->entityForm->reset();
        $this->reset('modal');
    }
}
