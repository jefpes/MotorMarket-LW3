<?php

namespace App\Livewire\Forms;

use App\Models\VehicleType;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Form;

class VehicleTypeForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $name = '';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name' => ['required', 'min:1', 'max:100', Rule::unique('vehicle_types')->ignore($this->id)],
        ];
    }

    public function save(): void
    {
        $this->validate();
        VehicleType::updateOrCreate(
            ['id' => $this->id],
            [
                'name' => $this->name,
            ]
        );
    }

    public function destroy(): void
    {
        VehicleType::find($this->id)->delete();
    }

    public function setVehicleType(int $id): void
    {
        $vtype      = VehicleType::find($id);
        $this->name = $vtype->name;
        $this->id   = $vtype->id;
    }

    public function cancel(): void
    {
        $this->reset();
    }
}
