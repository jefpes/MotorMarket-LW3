<?php

namespace App\Livewire\Supplier;

use App\Enums\{Genders, MaritalStatus, States};
use App\Models\{City, Supplier};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    use Toast;
    use Utilities;

    public string $header = 'Update Supplier';

    public function mount(int $id): void
    {
        $supplier = Supplier::findOrFail($id);
        $this->supplierForm->setSupplier($supplier);
        $this->supplierAddressForm->setAddress($supplier);
        $this->supplierPhotoForm->setPhoto($supplier);
    }
    public function render(): View
    {
        return view('livewire.supplierForm.create-update', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases(), 'genders' => Genders::cases()]);
    }

    public function save(): void
    {
        $this->authorize($this->permission_update);

        $this->supplierForm->validate();
        $this->supplierAddressForm->validate();

        $supplier = $this->supplierForm->save();

        // Salva o endereço do cliente
        $this->supplierAddressForm->entity_id = $supplier->id;
        $this->supplierAddressForm->save();

        // Processa e salva as fotos, se houver
        $this->supplierPhotoForm->save($supplier->id, $supplier->name);

        $this->toastSuccess('Supplier updated successfully');
    }
}
