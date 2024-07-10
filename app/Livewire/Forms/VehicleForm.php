<?php

namespace App\Livewire\Forms;

use App\Models\Vehicle;
use Livewire\Attributes\{Locked};
use Livewire\Form;

class VehicleForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $purchase_date = null;

    public ?float $purchase_price = null;

    public ?float $sale_price = null;

    public ?int $vehicle_type_id = null;

    public ?int $vehicle_model_id = null;

    public ?string $year_one = '2024';

    public ?string $year_two = '2024';

    public ?int $km = 0;

    public ?string $color = '';

    public ?string $plate = '';

    public ?string $chassi = '';

    public ?string $renavan = '';

    public ?string $description = '';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'purchase_date'    => ['required', 'date'],
            'purchase_price'   => ['required', 'numeric'],
            'sale_price'       => ['required', 'numeric'],
            'vehicle_model_id' => ['required', 'exists:vehicle_models,id', 'integer'],
            'year_one'         => ['required', 'integer', 'min:1900', 'max:2100'],
            'year_two'         => ['required', 'integer', 'min:1900', 'max:2100'],
            'km'               => ['required', 'integer', 'min:0'],
            'color'            => ['required', 'string', 'max:255', 'min:3'],
            'plate'            => ['required', 'string', 'size:8'],
            'chassi'           => ['required', 'string', 'max:255', 'min:3'],
            'renavan'          => ['required', 'string', 'max:255', 'min:3'],
            'description'      => ['required', 'string', 'max:255', 'min:10'],
        ];
    }

    public function save(): Vehicle
    {
        $this->validate();
        $people = Vehicle::updateOrCreate(
            ['id' => $this->id],
            [
                'purchase_date'    => $this->purchase_date,
                'purchase_price'   => $this->purchase_price,
                'sale_price'       => $this->sale_price,
                'vehicle_model_id' => $this->vehicle_model_id,
                'year_one'         => $this->year_one,
                'year_two'         => $this->year_two,
                'km'               => $this->km,
                'color'            => $this->color,
                'plate'            => $this->plate,
                'chassi'           => $this->chassi,
                'renavan'          => $this->renavan,
                'description'      => $this->description,
            ]
        );

        return $people;
    }

    public function setVehicle(int $id): void
    {
        $this->fill(Vehicle::find($id));
    }

    public function destroy(): void
    {
        Vehicle::find($this->id)->delete();
    }

    public function cancel(): void
    {
        $this->reset();
    }
}
