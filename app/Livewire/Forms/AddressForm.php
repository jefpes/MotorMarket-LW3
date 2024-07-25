<?php

namespace App\Livewire\Forms;

use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\{Locked};
use Livewire\Form;

abstract class AddressForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?int $entity_id = null;

    public ?string $zip_code = '';

    public ?string $street = '';

    public ?string $number = null;

    public ?string $neighborhood = '';

    public ?string $complement = '';

    public ?int $city_id = null;

    public ?string $state = '';

    abstract protected function getAddressModel(): Model;

    abstract protected function getEntityField(): string;

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'zip_code'     => ['required', 'size:9'],
            'street'       => ['required', 'min:3', 'max:255'],
            'number'       => ['required', 'min:1', 'max:10'],
            'neighborhood' => ['required', 'min:3', 'max:255'],
            'complement'   => ['nullable', 'min:3', 'max:255'],
            'city_id'      => ['required', 'exists:cities,id', 'integer'],
            'state'        => ['required', 'min:2', 'max:100'],
        ];
    }

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
