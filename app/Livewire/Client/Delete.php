<?php

namespace App\Livewire\Client;

use App\Enums\Permission;
use App\Livewire\Forms\ClientForm;
use App\Models\Client;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\{Locked, On};
use Livewire\Component;

class Delete extends Component
{
    use Toast;

    public ClientForm $form;

    #[Locked]
    public int $id;

    public bool $modal = false;

    public ?string $title = 'Deleting Client';

    public function render(): View
    {
        return view('livewire.client.delete');
    }

    #[On('client::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setClient(Client::find($id));
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize(Permission::CLIENT_DELETE->value);
        $client = Client::find($this->form->id);

        if($client->photos->isNotEmpty()) {
            foreach ($client->photos as $photo) {
                Storage::delete("/client_photos/" . $photo->photo_name);
            }
        }

        $this->form->destroy();
        $this->modal = false;

        $this->dispatch('client::refresh');

        $this->toastSuccess('Client Deleted');
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }
}
