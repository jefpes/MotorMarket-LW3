<?php

namespace App\Livewire\Client;

use App\Enums\{LogradouroType, States};
use App\Livewire\Forms\ClientForm;
use App\Models\City;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    use Toast;

    public ClientForm $form;

    public string $header = 'Update Client';

    /** @var array<Object> */
    public array $photos = [];

    public function mount(int $id): void
    {
        $this->form->setClient($id);
    }
    public function render(): View
    {
        return view('livewire.client.update', ['states' => States::cases(), 'logradouroType' => LogradouroType::cases(), 'cities' => City::all()]);
    }

    public function save(): void
    {
        $this->authorize('client_update');

        file_exists('storage/client_photos/') ?: Storage::makeDirectory('client_photos/');

        $client = $this->form->save();

        // create image manager with desired driver
        $manager = new ImageManager(new Driver());

        foreach ($this->photos as $photo) {
            // read image from file system
            $image = $manager->read($photo);

            // resize image proportionally to 300px width
            $image->scale(height: 1240);

            $path       = 'storage/client_photos/';
            $customName = $path . str_replace(' ', '_', $client->name) . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();

            // Save image
            $image->save($customName);

            $client->photos()->create([
                'photo_name' => str_replace($path, '', $customName),
                'format'     => $photo->getClientOriginalExtension(),
                'full_path'  => storage_path('app/public/') . $customName,
                'path'       => $customName,
            ]);
        }

        $this->msg  = 'Client updated successfully';
        $this->icon = 'icons.success';

        $this->dispatch('show-toast');
    }
}
