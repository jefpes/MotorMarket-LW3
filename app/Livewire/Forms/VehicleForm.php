<?php

namespace App\Livewire\Forms;

use App\Models\Vehicle;
use Livewire\Attributes\{Locked};
use Livewire\Form;

class VehicleForm extends Form
{
    public ?Vehicle $vehicle = null;

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

    public ?string $fuel = '';

    public ?string $engine_power = '';

    public ?string $steering = '';

    public ?string $transmission = '';

    public ?string $doors = '';

    public ?string $seats = '';

    public ?string $traction = '';

    public ?string $color = '';

    public ?string $plate = '';

    public ?string $chassi = '';

    public ?string $renavam = '';

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
            'fuel'             => ['required', 'string', 'max:40', 'min:2'],
            'engine_power'     => ['required', 'string', 'max:10', 'min:1'],
            'transmission'     => ['required', 'string', 'max:255', 'min:3'],
            'color'            => ['required', 'string', 'max:255', 'min:3'],
            'plate'            => ['required', 'string', 'size:8'],
            'chassi'           => ['required', 'string', 'max:255', 'min:3'],
            'renavam'          => ['required', 'string', 'max:255', 'min:3'],
            'description'      => ['required', 'string', 'max:255', 'min:10'],
        ];
    }

    public function save(): Vehicle
    {
        $this->validate();

        return Vehicle::updateOrCreate(
            ['id' => $this->id],
            [
                'purchase_date'    => $this->purchase_date,
                'purchase_price'   => $this->purchase_price,
                'sale_price'       => $this->sale_price,
                'vehicle_model_id' => $this->vehicle_model_id,
                'year_one'         => $this->year_one,
                'year_two'         => $this->year_two,
                'km'               => $this->km,
                'fuel'             => $this->fuel,
                'engine_power'     => $this->engine_power,
                'steering'         => $this->steering,
                'transmission'     => $this->transmission,
                'doors'            => $this->doors,
                'seats'            => $this->seats,
                'traction'         => $this->traction,
                'color'            => $this->color,
                'plate'            => $this->plate,
                'chassi'           => $this->chassi,
                'renavam'          => $this->renavam,
                'description'      => $this->description,
            ]
        );
    }

    public function setVehicle(Vehicle $v): void
    {
        $this->fill($v);
        $this->vehicle = $v;
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
