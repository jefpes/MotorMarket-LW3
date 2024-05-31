<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'purchase_date'    => '2024-05-24',
                'purchase_price'   => 10000.00,
                'sale_price'       => 15000.00,
                'vehicle_type_id'  => 1,
                'vehicle_model_id' => 1,
                'year_one'         => 2020,
                'year_two'         => 2021,
                'km'               => 10000,
                'color'            => 'Preto',
                'plate'            => 'ABC-1234',
                'chassi'           => '12345678901234567',
                'renavan'          => '12345678901',
                'description'      => 'Veículo em ótimo estado de conservação.',
            ],
            [
                'purchase_date'    => '2024-05-24',
                'purchase_price'   => 20000.00,
                'sale_price'       => 25000.00,
                'vehicle_type_id'  => 2,
                'vehicle_model_id' => 2,
                'year_one'         => 2020,
                'year_two'         => 2021,
                'km'               => 10000,
                'color'            => 'Preto',
                'plate'            => 'ABC-1235',
                'chassi'           => '12345678901234568',
                'renavan'          => '12345678902',
                'description'      => 'Veículo em ótimo estado de conservação.',
            ],
            [
                'purchase_date'    => '2024-05-24',
                'purchase_price'   => 18000.00,
                'sale_price'       => 23000.00,
                'vehicle_type_id'  => 2,
                'vehicle_model_id' => 3,
                'year_one'         => 2020,
                'year_two'         => 2021,
                'km'               => 10000,
                'color'            => 'Azul',
                'plate'            => 'ABC-1236',
                'chassi'           => '12345678901234566',
                'renavan'          => '12345678900',
                'description'      => 'Veículo em ótimo estado de conservação.',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            \App\Models\Vehicle::create($vehicle);
        }
    }
}
