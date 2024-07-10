<?php

namespace App\Livewire\Client;

use App\Enums\{MaritalStatus, States};
use App\Livewire\Forms\{ClientAddressForm, ClientForm, ClientPhotoForm};
use App\Models\City;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\{Component, WithFileUploads};

class Create extends Component
{
    use WithFileUploads;
    use Toast;

    public ClientForm $client;

    public ClientPhotoForm $clientPhoto;

    public ClientAddressForm $clientAddress;

    public string $header = 'Create Client';

    public function render(): View
    {
        return view('livewire.client.create-update', ['states' => States::cases(), 'cities' => City::all(), 'maritalStatus' => MaritalStatus::cases()]);
    }

    public function save(): void
    {
        $this->authorize('client_create');

        $this->client->validate();
        $this->clientAddress->validate();

        $client = $this->client->save();

        // Salva o endereço do cliente
        $this->clientAddress->entity_id = $client->id;
        $this->clientAddress->save($client); // @phpstan-ignore-line

        // Processa e salva as fotos, se houver
        $this->clientPhoto->save($client);

        $this->client->reset();
        $this->clientAddress->reset();
        $this->clientPhotos->reset(); // @phpstan-ignore-line

        $this->msg  = 'Client created successfully';
        $this->icon = 'icons.success';
        $this->dispatch('show-toast');
    }
}
