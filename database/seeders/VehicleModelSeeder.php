<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $models = [
            ['model' => 'Fiat Strada', 'brand_id' => 1],
            ['model' => 'Chevrolet Onix', 'brand_id' => 2],
            ['model' => 'Hyundai HB20', 'brand_id' => 3],
            ['model' => 'Volkswagen Polo', 'brand_id' => 4],
            ['model' => 'Fiat Argo', 'brand_id' => 1],
            ['model' => 'Chevrolet Onix Plus', 'brand_id' => 2],
            ['model' => 'Jeep Compass', 'brand_id' => 5],
            ['model' => 'Honda HR-V', 'brand_id' => 6],
            ['model' => 'Fiat Mobi', 'brand_id' => 1],
            ['model' => 'Hyundai Creta', 'brand_id' => 3],
            ['model' => 'Volkswagen T-Cross', 'brand_id' => 4],
            ['model' => 'Renault Kwid', 'brand_id' => 7],
            ['model' => 'Chevrolet Tracker', 'brand_id' => 2],
            ['model' => 'Toyota Corolla Cross', 'brand_id' => 8],
            ['model' => 'Fiat Toro', 'brand_id' => 1],
            ['model' => 'Volkswagen Nivus', 'brand_id' => 4],
            ['model' => 'Fiat Cronos', 'brand_id' => 1],
            ['model' => 'Fiat Pulse', 'brand_id' => 1],
            ['model' => 'Toyota Corolla', 'brand_id' => 8],
            ['model' => 'Jeep Renegade', 'brand_id' => 5],
            ['model' => 'Toyota Hilux', 'brand_id' => 8],
            ['model' => 'Volkswagen Saveiro', 'brand_id' => 4],
            ['model' => 'Chevrolet Montana', 'brand_id' => 2],
            ['model' => 'Nissan Kicks', 'brand_id' => 9],
            ['model' => 'Chevrolet S10', 'brand_id' => 2],
            ['model' => 'Fiat Fastback', 'brand_id' => 1],
            ['model' => 'Volkswagen Virtus', 'brand_id' => 4],
            ['model' => 'Citroën C3', 'brand_id' => 10],
            ['model' => 'Hyundai HB20S', 'brand_id' => 3],
            ['model' => 'Peugeot 208', 'brand_id' => 11],
            ['model' => 'Jeep Commander', 'brand_id' => 5],
            ['model' => 'Honda City', 'brand_id' => 6],
            ['model' => 'Toyota Yaris', 'brand_id' => 8],
            ['model' => 'Renault Duster', 'brand_id' => 7],
            ['model' => 'Fiat Fiorino', 'brand_id' => 1],
            ['model' => 'Ford Ranger', 'brand_id' => 12],
            ['model' => 'Renault Oroch', 'brand_id' => 7],
            ['model' => 'Toyota Hilux SW4', 'brand_id' => 8],
            ['model' => 'Chevrolet Spin', 'brand_id' => 2],
            ['model' => 'Toyota Yaris Sedan', 'brand_id' => 8],
        ];

        foreach ($models as $model) {
            \App\Models\VehicleModel::create($model);
        }
    }
}
