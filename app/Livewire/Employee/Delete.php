<?php

namespace App\Livewire\Employee;

use App\Livewire\Forms\ClientForm;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\{Locked, On};
use Livewire\Component;

class Delete extends Component
{
    public ClientForm $form;

    #[Locked]
    public int $id;

    public bool $modal = false;

    public ?string $icon = 'icons.success';

    public ?string $msg = 'Client Deleted';

    public ?string $title = 'Deleting Client';

    public function render(): View
    {
        return view('livewire.employee.delete');
    }

    #[On('client::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setClient($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize('client_delete');
        $client = Client::find($this->form->id);

        if($client->photos->isNotEmpty()) {
            foreach ($client->photos as $photo) {
                Storage::delete("/client_photos/" . $photo->photo_name);
            }
        }

        $this->form->destroy();
        $this->modal = false;

        $this->dispatch('client::refresh');

        $this->dispatch('show-toast');
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }
}
