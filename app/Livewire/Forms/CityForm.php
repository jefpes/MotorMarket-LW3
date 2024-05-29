<?php

namespace App\Livewire\Forms;

use App\Models\City;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Form;

class CityForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $name = '';

    public bool $new = true;

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:100', Rule::unique('cities')->ignore($this->id)],
        ];
    }

    public function save(): void
    {
        $this->validate();
        City::updateOrCreate(
            ['id' => $this->id],
            [
                'name' => $this->name,
            ]
        );
    }

    public function destroy(): void
    {
        City::find($this->id)->delete();
    }

    public function setCity(int $id): void
    {
        $city       = City::find($id);
        $this->name = $city->name;
        $this->id   = $city->id;
    }

    public function cancel(): void
    {
        $this->reset();
    }
}
