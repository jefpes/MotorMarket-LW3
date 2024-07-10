<?php

namespace App\Livewire\Forms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Storage};
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\{Locked, Validate};
use Livewire\Form;

abstract class PhotoForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?int $entity_id = null;

    #[Validate('required', 'min:3', 'max:255')]
    public ?string $photo_name = '';

    #[Validate('required', 'max:25')]
    public ?string $format = '';

    #[Validate('required', 'min:3', 'max:255')]
    public ?string $full_path = '';

    #[Validate('required', 'min:3', 'max:255')]
    public ?string $path = '';

    /** @var array<Object> */
    public array $photos;

    public ?string $directory = '';

    abstract protected function getPhotoModel(): Model;

    abstract protected function getEntityField(): string;

    abstract protected function getDirectory(): string;

    public function save(Model $entity): void
    {
        $this->validate();

        file_exists('storage/' . $this->getDirectory()) ?: Storage::makeDirectory($this->getDirectory());

        if (!empty($this->photos)) {
            $manager = new ImageManager(new Driver());

            foreach ($this->photos as $photo) {
                $image = $manager->read($photo->getRealPath())->scale(height: 1240);

                $path       = 'storage/' . $this->getDirectory();
                $customName = $path . str_replace(' ', '_', $entity->name) . '_' . uniqid() . '.' . $photo->getClientOriginalExtension(); // @phpstan-ignore-line

                $image->save($customName);

                $this->getPhotoModel()->updateOrCreate(
                    ['id' => $this->id],
                    [
                        $this->getEntityField() => $entity->id, // @phpstan-ignore-line
                        'photo_name'            => str_replace($path, '', $customName),
                        'format'                => $photo->getClientOriginalExtension(),
                        'full_path'             => storage_path('app/public/') . str_replace('storage/', '', $customName),
                        'path'                  => $customName,
                    ]
                );
            }
        }
    }

    public function deleteOldPhotos(Model $entity): void
    {
        if (!empty($this->photos)) {
            foreach ($entity->photos as $photo) { // @phpstan-ignore-line
                if (Storage::exists("/" . $this->getDirectory() . $photo->photo_name)) {
                    Storage::delete("/" . $this->getDirectory() . $photo->photo_name);
                }
                $photo->delete();
            }
        }
    }

    public function setPhoto(Model $entity): void
    {
        $photo = $this->getPhotoModel()->where($this->getEntityField(), $entity->id)->first(); // @phpstan-ignore-line

        $this->fill($photo);
    }

    public function setPhotos(Model $entity): void
    {
        $this->photos = $this->getPhotoModel()->where($this->getEntityField(), $entity->id); // @phpstan-ignore-line
    }
}
