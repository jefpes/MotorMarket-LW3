<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
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
        $this->supplierForm->setSupplier(Supplier::find($id));
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize($this->permission_delete);
        $supplier = Supplier::find($this->supplier->id);

        if($supplier->photos->isNotEmpty()) {
            foreach ($supplier->photos as $photo) {
                Storage::delete("/supplier_photos/" . $photo->photo_name);
            }
        }

        $this->supplierForm->destroy();
        $this->modal = false;

        $this->dispatch('supplier::refresh');

        $this->toastSuccess('Supplier Deleted');
    }

    public function cancel(): void
    {
        $this->supplierForm->reset();
        $this->reset('modal');
    }
}
