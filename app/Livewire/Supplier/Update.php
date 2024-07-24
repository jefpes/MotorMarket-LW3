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
        $this->entityForm->setSupplier($supplier);
        $this->entityAddressForm->setAddress($supplier);
        $this->entityPhotoForm->setPhoto($supplier);
    }
    public function render(): View
    {
        return view('livewire.entityForm.create-update', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases(), 'genders' => Genders::cases()]);
    }

    public function save(): void
    {
        $this->authorize($this->permission_update);

        $this->entityForm->validate();
        $this->entityAddressForm->validate();

        $supplier = $this->entityForm->save();

        // Salva o endereço do cliente
        $this->entityAddressForm->entity_id = $supplier->id;
        $this->entityAddressForm->save();

        // Processa e salva as fotos, se houver
        $this->entityPhotoForm->save($supplier->id, $supplier->name);

        $this->toastSuccess('Supplier updated successfully');
    }
}
