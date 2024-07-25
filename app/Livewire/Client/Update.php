<?php

namespace App\Livewire\Client;

use App\Enums\{Genders, MaritalStatus, States};
use App\Models\{City, Client};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    use Toast;
    use Utilities;

    public string $header = 'Update Client';

    public function mount(int $id): void
    {
        $client = Client::findOrFail($id);
        $this->entityForm->setClient($client);
        $this->entityAddressForm->setAddress($client);
        $this->entityPhotoForm->setPhoto($client);
    }
    public function render(): View
    {
        return view('livewire.client.create-update', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases(), 'genders' => Genders::cases()]);
    }

    public function save(): void
    {
        $this->authorize($this->permission_update);

        $this->entityForm->validate();
        $this->entityAddressForm->validate();

        $client = $this->entityForm->save();

        $this->entityAddressForm->entity_id = $client->id;
        $this->entityAddressForm->save();

        $this->entityPhotoForm->save($client->id, $client->name);

        $this->toastSuccess('Client updated successfully');
    }
}
