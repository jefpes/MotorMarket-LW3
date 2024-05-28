<?php

namespace App\Livewire\Client;

use App\Enums\States;
use App\Livewire\Forms\ClientForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\{Component, WithFileUploads};

class Create extends Component
{
    use WithFileUploads;
    use Toast;

    public ClientForm $form;

    public string $header = 'Create Client';

    /** @var array<Object> */
    public array $photos;

    public function render(): View
    {
        return view('livewire.client.create', ['states' => States::cases()]);
    }

    public function save(): void
    {
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
                'full_path'  => storage_path('app/public/') . str_replace('storage/', '', $customName),
                'path'       => $customName,
            ]);
        }
        $this->form->reset();

        $this->msg  = 'Client created successfully';
        $this->icon = 'icons.success';
        $this->dispatch('show-toast');
    }
}
