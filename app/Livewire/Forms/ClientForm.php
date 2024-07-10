<?php

namespace App\Livewire\Forms;

use App\Models\Client;
use Livewire\Attributes\{Locked};
use Livewire\Form;

class ClientForm extends Form
{
    public Client $client;

    #[Locked]
    public ?int $id = null;

    public ?string $name = null;

    public ?string $rg = null;

    public ?string $cpf = null;

    public ?string $marital_status = null;

    public ?string $phone_one = null;

    public ?string $phone_two = null;

    public ?string $birth_date = null;

    public ?string $father = '';

    public ?string $mother = '';

    public ?string $affiliated_one = '';

    public ?string $affiliated_two = '';

    public ?string $description = '';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name'           => ['required', 'min:3', 'max:255'],
            'rg'             => ['required', 'min:3', 'max:20'],
            'cpf'            => ['required', 'size:14'],
            'marital_status' => ['required', 'min:3', 'max:255'],
            'phone_one'      => ['required', 'size:15'],
            'phone_two'      => ['nullable', 'min:3', 'max:20'],
            'birth_date'     => ['required', 'date'],
            'father'         => ['nullable', 'min:3', 'max:255'],
            'mother'         => ['nullable', 'min:3', 'max:255'],
            'affiliated_one' => ['nullable', 'min:3', 'max:255'],
            'affiliated_two' => ['nullable', 'min:3', 'max:255'],
            'description'    => ['nullable', 'min:3', 'max:255'],
        ];
    }

    public function save(): Client
    {
        $this->validate();
        $client = Client::updateOrCreate(
            ['id' => $this->id],
            [
                'name'           => $this->name,
                'rg'             => $this->rg,
                'cpf'            => $this->cpf,
                'marital_status' => $this->marital_status,
                'phone_one'      => $this->phone_one,
                'phone_two'      => $this->phone_two,
                'birth_date'     => $this->birth_date,
                'father'         => $this->father,
                'mother'         => $this->mother,
                'affiliated_one' => $this->affiliated_one,
                'affiliated_two' => $this->affiliated_two,
                'description'    => $this->description,
            ]
        );

        return $client;
    }

    public function setClient(Client $client): void
    {
        $this->fill($client);
        $this->client = $client;
    }

    public function destroy(): void
    {
        Client::find($this->id)->delete();
    }
}
