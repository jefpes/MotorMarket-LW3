<?php

namespace App\Livewire\Supplier;

use App\Enums\{Genders, MaritalStatus, States};
use App\Models\City;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\{Component, WithFileUploads};

class Create extends Component
{
    use WithFileUploads;
    use Toast;
    use Utilities;

    public string $header = 'Create Supplier';

    public function render(): View
    {
        return view('livewire.supplier.create-update', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases(), 'genders' => Genders::cases()]);
    }

    public function save(): void
    {
        $this->authorize($this->permission_create);

        $this->entityForm->validate();
        $this->entityAddressForm->validate();

        $supplier = $this->entityForm->save();

        // Salva o endereço do cliente
        $this->entityAddressForm->entity_id = $supplier->id;
        $this->entityAddressForm->save($supplier); // @phpstan-ignore-line

        // Processa e salva as fotos, se houver
        $this->entityPhotoForm->save($supplier->id, $supplier->name);

        $this->entityForm->reset();
        $this->entityAddressForm->reset();
        $this->supplierPhotosForm->reset(); // @phpstan-ignore-line

        $this->toastSuccess('Supplier created successfully');
    }
}
