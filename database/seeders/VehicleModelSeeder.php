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
            ['name' => 'Strada', 'brand_id' => 1],
            ['name' => 'Uno', 'brand_id' => 1],
            ['name' => 'Vivace', 'brand_id' => 1],
            ['name' => 'Onix', 'brand_id' => 2],
            ['name' => 'Corsa', 'brand_id' => 2],
            ['name' => 'HB20', 'brand_id' => 3],
            ['name' => 'Polo', 'brand_id' => 4],
            ['name' => 'Gol', 'brand_id' => 4],
            ['name' => 'Argo', 'brand_id' => 1],
            ['name' => 'Onix Plus', 'brand_id' => 2],
            ['name' => 'Compass', 'brand_id' => 5],
            ['name' => 'HR-V', 'brand_id' => 6],
            ['name' => 'Mobi', 'brand_id' => 1],
            ['name' => 'Creta', 'brand_id' => 3],
            ['name' => 'T-Cross', 'brand_id' => 4],
            ['name' => 'Kwid', 'brand_id' => 7],
            ['name' => 'Tracker', 'brand_id' => 2],
            ['name' => 'Corolla Cross', 'brand_id' => 8],
            ['name' => 'Toro', 'brand_id' => 1],
            ['name' => 'Nivus', 'brand_id' => 4],
            ['name' => 'Cronos', 'brand_id' => 1],
            ['name' => 'Pulse', 'brand_id' => 1],
            ['name' => 'Corolla', 'brand_id' => 8],
            ['name' => 'Renegade', 'brand_id' => 5],
            ['name' => 'Hilux', 'brand_id' => 8],
            ['name' => 'Saveiro', 'brand_id' => 4],
            ['name' => 'Montana', 'brand_id' => 2],
            ['name' => 'Kicks', 'brand_id' => 9],
            ['name' => 'S10', 'brand_id' => 2],
            ['name' => 'Fastback', 'brand_id' => 1],
            ['name' => 'Virtus', 'brand_id' => 4],
            ['name' => 'C3', 'brand_id' => 10],
            ['name' => 'HB20S', 'brand_id' => 3],
            ['name' => '208', 'brand_id' => 11],
            ['name' => 'Commander', 'brand_id' => 5],
            ['name' => 'City', 'brand_id' => 6],
            ['name' => 'Yaris', 'brand_id' => 8],
            ['name' => 'Duster', 'brand_id' => 7],
            ['name' => 'Fiorino', 'brand_id' => 1],
            ['name' => 'Ranger', 'brand_id' => 12],
            ['name' => 'Oroch', 'brand_id' => 7],
            ['name' => 'Hilux SW4', 'brand_id' => 8],
            ['name' => 'Spin', 'brand_id' => 2],
            ['name' => 'Yaris Sedan', 'brand_id' => 8],
        ];

        foreach ($models as $model) {
            \App\Models\VehicleModel::create($model);
        }
    }
}
