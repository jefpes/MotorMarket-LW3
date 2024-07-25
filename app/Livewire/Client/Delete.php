<?php

namespace App\Livewire\Client;

use App\Models\Client;
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

    public ?string $title = 'Deleting Client';

    public function render(): View
    {
        return view('livewire.client.delete');
    }

    #[On('client::deleting')]
    public function deleting(int $id): void
    {
        $this->entityForm->setClient(Client::find($id));
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize($this->permission_delete);

        $client = Client::find($this->entityForm->id);

        try {
            $this->entityForm->destroy();
            $this->entityPhotoForm->deleteOldPhotos($client);
            $this->entityForm->reset();
            $this->modal = false;
            $this->dispatch('client::refresh');
            $this->toastSuccess('Client Deleted');

        } catch (\Exception $e) {
            $this->toastFail('Client Not Deleted');
            $this->modal = false;
        }
    }

    public function cancel(): void
    {
        $this->entityForm->reset();
        $this->reset('modal');
    }
}
