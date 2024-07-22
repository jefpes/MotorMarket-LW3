<?php

namespace App\Livewire\Client;

use App\Enums\Permission;
use App\Models\{Client, ClientPhoto};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Show extends Component
{
    use Toast;

    public bool $modal = false;

    public Client $client;

    public ClientPhoto $photo;

    public string $header = 'Showing Client';

    public function mount(int $id): void
    {
        $this->client = Client::with('photos')->findOrFail($id);
    }

    public function render(): View
    {
        return view('livewire.client.show');
    }

    public function cancel(): void
    {
        $this->reset('modal');
    }

    public function actions(int $id): void
    {
        $this->photo = ClientPhoto::findOrFail($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize(Permission::CLIENT_PHOTO_DELETE->value);

        try {
            Storage::delete("/client_photos/" . $this->photo->photo_name);
            $this->photo->delete();
            $this->modal = false;

            $this->icon = 'icons.success';
            $this->msg  = 'Photo Deleted';

            $this->dispatch('show-toast');
        } catch (\Exception $e) {
            $this->modal = false;
            $this->icon  = 'icons.fail';
            $this->msg   = 'Failed to delete photo';
            $this->dispatch('show-toast');
        }
    }

    public function download(): BinaryFileResponse
    {
        $response = null;

        try {
            $response = response()->download($this->photo->path, $this->photo->photo_name);

            $this->icon = 'icons.success';
            $this->msg  = 'Photo Downloaded';

            $this->dispatch('show-toast');

        } catch (\Throwable $th) {
            $this->icon = 'icons.fail';
            $this->msg  = 'Download photo, failed';

            $this->dispatch('show-toast');
        }

        return $response;
    }
}
