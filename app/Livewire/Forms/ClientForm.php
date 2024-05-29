<?php

namespace App\Livewire\Forms;

use App\Models\Client;
use Livewire\Attributes\{Locked};
use Livewire\Form;

class ClientForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $name = null;

    public ?string $rg = null;

    public ?string $cpf = null;

    public ?string $phone_one = null;

    public ?string $phone_two = null;

    public ?string $birth_date = null;

    public ?string $father = '';

    public ?string $mother = '';

    public ?string $affiliated_one = '';

    public ?string $affiliated_two = '';

    public ?string $description = '';

    public ?string $cep = '';

    public ?string $logradouro_type = '';

    public ?string $logradouro = '';

    public ?int $number = null;

    public ?string $complement = '';

    public ?string $bairro = '';

    public ?int $city_id = null;

    public ?string $state = '';

    public ?string $country = 'Brasil';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name'            => ['required', 'min:3', 'max:255'],
            'rg'              => ['required', 'min:3', 'max:20'],
            'cpf'             => ['required', 'size:14'],
            'phone_one'       => ['required', 'size:15'],
            'phone_two'       => ['nullable', 'min:3', 'max:20'],
            'birth_date'      => ['required', 'date'],
            'father'          => ['nullable', 'min:3', 'max:255'],
            'mother'          => ['nullable', 'min:3', 'max:255'],
            'affiliated_one'  => ['nullable', 'min:3', 'max:255'],
            'affiliated_two'  => ['nullable', 'min:3', 'max:255'],
            'description'     => ['nullable', 'min:3', 'max:255'],
            'cep'             => ['required', 'size:9'],
            'logradouro_type' => ['required', 'min:2', 'max:255'], // 'required', 'in:'.implode(',', LogradouroType::cases()), // 'required', 'min:3', 'max:255
            'logradouro'      => ['required', 'min:3', 'max:255'],
            'number'          => ['integer', 'min:1', 'max:99999'],
            'complement'      => ['nullable', 'min:3', 'max:255'],
            'bairro'          => ['required', 'min:3', 'max:100'],
            'city_id'         => ['required', 'exists:cities,id', 'integer'],
            'state'           => ['required', 'min:2', 'max:100'],
            'country'         => ['required', 'min:3', 'max:100'],
        ];
    }

    public function save(): Client
    {
        $this->validate();
        $client = Client::updateOrCreate(
            ['id' => $this->id],
            [
                'name'            => $this->name,
                'rg'              => $this->rg,
                'cpf'             => $this->cpf,
                'phone_one'       => $this->phone_one,
                'phone_two'       => $this->phone_two,
                'birth_date'      => $this->birth_date,
                'father'          => $this->father,
                'mother'          => $this->mother,
                'affiliated_one'  => $this->affiliated_one,
                'affiliated_two'  => $this->affiliated_two,
                'description'     => $this->description,
                'cep'             => $this->cep,
                'logradouro_type' => $this->logradouro_type,
                'logradouro'      => $this->logradouro,
                'number'          => $this->number,
                'complement'      => $this->complement,
                'bairro'          => $this->bairro,
                'city_id'         => $this->city_id,
                'state'           => $this->state,
                'country'         => $this->country,
            ]
        );

        return $client;
    }

    public function setClient(int $id): void
    {
        $client                = Client::find($id);
        $this->id              = $client->id;
        $this->name            = $client->name;
        $this->rg              = $client->rg;
        $this->cpf             = $client->cpf;
        $this->phone_one       = $client->phone_one;
        $this->phone_two       = $client->phone_two;
        $this->birth_date      = $client->birth_date;
        $this->father          = $client->father;
        $this->mother          = $client->mother;
        $this->affiliated_one  = $client->affiliated_one;
        $this->affiliated_two  = $client->affiliated_two;
        $this->description     = $client->description;
        $this->cep             = $client->cep;
        $this->logradouro_type = $client->logradouro_type;
        $this->logradouro      = $client->logradouro;
        $this->number          = $client->number;
        $this->complement      = $client->complement;
        $this->bairro          = $client->bairro;
        $this->city_id         = $client->city_id;
        $this->state           = $client->state;
        $this->country         = $client->country;
    }

    public function destroy(): void
    {
        Client::find($this->id)->delete();
    }
}
