<?php

namespace App\Livewire\Client;

use App\Enums\{Genders, MaritalStatus, States};
use App\Livewire\Forms\{ClientAddressForm, ClientForm, ClientPhotoForm};
use App\Models\{City, Client};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    use Toast;

    public ClientForm $client;

    public ClientPhotoForm $clientPhoto;

    public ClientAddressForm $clientAddress;

    public string $header = 'Update Client';

    public function mount(int $id): void
    {
        $client = Client::findOrFail($id);
        $this->client->setClient($client);
        $this->clientAddress->setAddress($client);
        $this->clientPhoto->setPhoto($client);
    }
    public function render(): View
    {
        return view('livewire.client.create-update', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases(), 'genders' => Genders::cases()]);
    }

    public function save(): void
    {
        $this->authorize('client_update');

        $this->client->validate();
        $this->clientAddress->validate();

        $client = $this->client->save();

        // Salva o endereço do cliente
        $this->clientAddress->entity_id = $client->id;
        $this->clientAddress->save();

        // Processa e salva as fotos, se houver
        $this->clientPhoto->save($client->id, $client->name);

        $this->toastSuccess('Client updated successfully');
    }
}
