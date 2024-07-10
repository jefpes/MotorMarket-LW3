<?php

namespace App\Livewire\Forms;

use Illuminate\Database\Eloquent\Model;
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

    abstract protected function getPhotoModel(): Model;

    abstract protected function getEntityField(): string;

    public function save(): void
    {
        $this->validate();

        $this->getPhotoModel()->updateOrCreate(
            ['id' => $this->id],
            [
                $this->getEntityField() => $this->entity_id,
                'photo_name'            => $this->photo_name,
                'format'                => $this->format,
                'full_path'             => $this->full_path,
                'path'                  => $this->path,
            ]
        );
    }

    public function setPhoto(Model $entity): void
    {
        $photo = $this->getPhotoModel()->where($this->getEntityField(), $entity->id)->first(); // @phpstan-ignore-line

        if ($photo) {
            $this->fill($photo->toArray());
            $this->id        = $photo->id; // @phpstan-ignore-line
            $this->entity_id = $entity->id; // @phpstan-ignore-line
        }
    }
}
