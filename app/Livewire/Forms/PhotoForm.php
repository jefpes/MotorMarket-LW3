<?php

namespace App\Livewire\Forms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Storage};
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\{Locked};
use Livewire\Form;

abstract class PhotoForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?int $entity_id = null;

    public ?string $photo_name = '';

    public ?string $format = '';

    public ?string $full_path = '';

    public ?string $path = '';

    /** @var array<Object> */
    public ?array $photos;

    abstract protected function getPhotoModel(): Model;

    abstract protected function getEntityField(): string;

    abstract protected function getDirectory(): string;

    public function save(int $id, string $name): void
    {
        file_exists('storage/' . $this->getDirectory()) ?: Storage::makeDirectory($this->getDirectory());

        if (!empty($this->photos)) {
            $manager = new ImageManager(new Driver());

            foreach ($this->photos as $photo) {
                // read image from file system and resize image proportionally to 300px width
                $image = $manager->read($photo)->scale(height: 1240);

                $path       = 'storage/' . $this->getDirectory();
                $customName = $path . str_replace(' ', '_', $name) . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();

                $image->save($customName);

                $this->getPhotoModel()->create(
                    [
                        $this->getEntityField() => $id,
                        'photo_name'            => str_replace($path, '', $customName),
                        'format'                => $photo->getClientOriginalExtension(),
                        'full_path'             => storage_path('app/public/') . str_replace('storage/', '', $customName),
                        'path'                  => $customName,
                    ]
                );
            }
        }
        $this->photos = null;
    }

    public function deleteOldPhotos(Model $entity): void
    {
        if (!empty($entity->photos->first())) { // @phpstan-ignore-line
            foreach ($entity->photos as $photo) { // @phpstan-ignore-line
                if (Storage::exists("/" . $this->getDirectory() . $photo->photo_name)) {
                    Storage::delete("/" . $this->getDirectory() . $photo->photo_name);
                }
                $photo->delete();
            }
        }
    }

    //passar um Model de photo
    public function deletePhoto(Model $entity): void
    {
        Storage::delete("/" . $this->getDirectory() . $entity->photo_name); // @phpstan-ignore-line
        $entity->delete();
    }

    public function setPhoto(Model $entity): void
    {
        $photo = $this->getPhotoModel()->where($this->getEntityField(), $entity->id)->first(); // @phpstan-ignore-line

        if ($photo) {
            $this->id         = $photo->id; // @phpstan-ignore-line
            $this->entity_id  = $photo->{$this->getEntityField()};
            $this->photo_name = $photo->photo_name; // @phpstan-ignore-line
            $this->format     = $photo->format; // @phpstan-ignore-line
            $this->full_path  = $photo->full_path; // @phpstan-ignore-line
            $this->path       = $photo->path; // @phpstan-ignore-line
        }
    }

    public function setPhotos(Model $entity): void
    {
        $this->photos = $this->getPhotoModel()->where($this->getEntityField(), $entity->id)->toArray(); // @phpstan-ignore-line
    }
}
