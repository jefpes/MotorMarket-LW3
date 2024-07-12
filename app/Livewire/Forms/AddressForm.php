<?php

namespace App\Livewire\Forms;

use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\{Locked, Validate};
use Livewire\Form;

abstract class AddressForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?int $entity_id = null;

    #[Validate('required', 'size:9')]
    public ?string $zip_code = '';

    #[Validate('required', 'min:3', 'max:255')]
    public ?string $street = '';

    #[Validate('required', 'integer')]
    public ?int $number = null;

    #[Validate('required', 'min:3', 'max:255')]
    public ?string $neighborhood = '';

    #[Validate('nullable', 'min:3', 'max:255')]
    public ?string $complement = '';

    #[Validate('required', 'exists:cities,id', 'integer')]
    public ?int $city_id = null;

    #[Validate('required', 'min:2', 'max:100')]
    public ?string $state = '';

    abstract protected function getAddressModel(): Model;

    abstract protected function getEntityField(): string;

    public function save(): void
    {
        $this->validate();

        $this->getAddressModel()->updateOrCreate(
            ['id' => $this->id],
            [
                $this->getEntityField() => $this->entity_id,
                'zip_code'              => $this->zip_code,
                'street'                => $this->street,
                'number'                => $this->number,
                'neighborhood'          => $this->neighborhood,
                'complement'            => $this->complement,
                'city_id'               => $this->city_id,
                'state'                 => $this->state,
            ]
        );
    }

    public function setAddress(Model $entity): void
    {
        $address = $this->getAddressModel()->where($this->getEntityField(), $entity->id)->first(); // @phpstan-ignore-line

        if ($address) {
            $this->fill($address->toArray());
            $this->id        = $address->id; // @phpstan-ignore-line
            $this->entity_id = $entity->id; // @phpstan-ignore-line
        }
    }
}
