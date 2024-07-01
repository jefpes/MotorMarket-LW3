<?php

namespace App\Livewire\Forms;

use App\Models\{EmployeeAddress, Employees};
use Livewire\Attributes\{Locked};
use Livewire\Form;

class ClientForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $zip_code = '';

    public ?string $street = '';

    public ?int $number = null;

    public ?string $neighborhood = '';

    public ?string $complement = '';

    public ?int $city_id = null;

    public ?string $state = '';

    public ?string $country = 'Brasil';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'zip_code'     => ['required', 'size:9'],
            'street'       => ['required', 'min:3', 'max:255'],
            'number'       => ['required', 'integer'],
            'neighborhood' => ['required', 'min:3', 'max:255'],
            'complement'   => ['nullable', 'min:3', 'max:255'],
            'city_id'      => ['required', 'exists:cities,id', 'integer'],
            'state'        => ['required', 'min:2', 'max:100'],
            'country'      => ['required', 'min:3', 'max:100'],
        ];
    }

    public function save(Employees $employee): void
    {
        $this->validate();
        $employee->address()->updateOrCreate(
            ['id' => $this->id],
            [
                'zip_code'     => $this->zip_code,
                'street'       => $this->street,
                'number'       => $this->number,
                'neighborhood' => $this->neighborhood,
                'complement'   => $this->complement,
                'city_id'      => $this->city_id,
                'state'        => $this->state,
                'country'      => $this->country,
            ]
        );
    }

    public function setEmployeeAddress(int $id): void
    {
        $address            = EmployeeAddress::find($id);
        $this->id           = $address->id;
        $this->zip_code     = $address->zip_code; /* @phpstan-ignore-line */
        $this->street       = $address->street; /* @phpstan-ignore-line */
        $this->number       = $address->number; /* @phpstan-ignore-line */
        $this->neighborhood = $address->neighborhood; /* @phpstan-ignore-line */
        $this->complement   = $address->complement; /* @phpstan-ignore-line */
        $this->city_id      = $address->city_id; /* @phpstan-ignore-line */
        $this->state        = $address->state; /* @phpstan-ignore-line */
        $this->country      = $address->country; /* @phpstan-ignore-line */
    }
}
