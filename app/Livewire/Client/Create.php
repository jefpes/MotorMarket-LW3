<?php

namespace App\Livewire\Client;

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

    public string $header = 'Create Client';

    public function render(): View
    {
        return view('livewire.client.create-update', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases(), 'genders' => Genders::cases()]);
    }

    public function save(): void
    {
        $this->authorize($this->permission_create);

        $this->entityForm->validate();
        $this->entityAddressForm->validate();

        $client = $this->entityForm->save();

        // Salva o endereço do cliente
        $this->entityAddressForm->entity_id = $client->id;
        $this->entityAddressForm->save();

        // Processa e salva as fotos, se houver
        $this->entityPhotoForm->save($client->id, $client->name);

        $this->entityForm->reset();
        $this->entityAddressForm->reset();

        $this->toastSuccess('Client created successfully');
    }
}
