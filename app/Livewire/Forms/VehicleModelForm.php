<?php

namespace App\Livewire\Forms;

use App\Models\VehicleModel;
use Illuminate\Validation\Rule;
use Livewire\Attributes\{Locked};
use Livewire\Form;

class VehicleModelForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $name = '';

    public ?int $brand_id;

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name'     => ['required', 'min:1', 'max:100', Rule::unique('roles')->ignore($this->id)],
            'brand_id' => ['required', 'exists:brands,id', 'integer'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        VehicleModel::updateOrCreate(
            ['id' => $this->id],
            [
                'name'     => $this->name,
                'brand_id' => $this->brand_id,
            ]
        );
    }

    public function destroy(): void
    {
        $r = VehicleModel::find($this->id);
        $r->delete();
    }

    public function setVehicleModel(int $id): void
    {
        $vehicleModel   = VehicleModel::find($id);
        $this->name     = $vehicleModel->name;
        $this->id       = $vehicleModel->id;
        $this->brand_id = $vehicleModel->brand_id;
    }

    public function cancel(): void
    {
        $this->reset();
    }

}
