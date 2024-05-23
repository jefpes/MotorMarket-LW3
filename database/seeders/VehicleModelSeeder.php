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
            ['model' => 'Strada', 'brand_id' => 1],
            ['model' => 'Uno', 'brand_id' => 1],
            ['model' => 'Vivace', 'brand_id' => 1],
            ['model' => 'Onix', 'brand_id' => 2],
            ['model' => 'Corsa', 'brand_id' => 2],
            ['model' => 'HB20', 'brand_id' => 3],
            ['model' => 'Polo', 'brand_id' => 4],
            ['model' => 'Gol', 'brand_id' => 4],
            ['model' => 'Argo', 'brand_id' => 1],
            ['model' => 'Onix Plus', 'brand_id' => 2],
            ['model' => 'Compass', 'brand_id' => 5],
            ['model' => 'HR-V', 'brand_id' => 6],
            ['model' => 'Mobi', 'brand_id' => 1],
            ['model' => 'Creta', 'brand_id' => 3],
            ['model' => 'T-Cross', 'brand_id' => 4],
            ['model' => 'Kwid', 'brand_id' => 7],
            ['model' => 'Tracker', 'brand_id' => 2],
            ['model' => 'Corolla Cross', 'brand_id' => 8],
            ['model' => 'Toro', 'brand_id' => 1],
            ['model' => 'Nivus', 'brand_id' => 4],
            ['model' => 'Cronos', 'brand_id' => 1],
            ['model' => 'Pulse', 'brand_id' => 1],
            ['model' => 'Corolla', 'brand_id' => 8],
            ['model' => 'Renegade', 'brand_id' => 5],
            ['model' => 'Hilux', 'brand_id' => 8],
            ['model' => 'Saveiro', 'brand_id' => 4],
            ['model' => 'Montana', 'brand_id' => 2],
            ['model' => 'Kicks', 'brand_id' => 9],
            ['model' => 'S10', 'brand_id' => 2],
            ['model' => 'Fastback', 'brand_id' => 1],
            ['model' => 'Virtus', 'brand_id' => 4],
            ['model' => 'C3', 'brand_id' => 10],
            ['model' => 'HB20S', 'brand_id' => 3],
            ['model' => '208', 'brand_id' => 11],
            ['model' => 'Commander', 'brand_id' => 5],
            ['model' => 'City', 'brand_id' => 6],
            ['model' => 'Yaris', 'brand_id' => 8],
            ['model' => 'Duster', 'brand_id' => 7],
            ['model' => 'Fiorino', 'brand_id' => 1],
            ['model' => 'Ranger', 'brand_id' => 12],
            ['model' => 'Oroch', 'brand_id' => 7],
            ['model' => 'Hilux SW4', 'brand_id' => 8],
            ['model' => 'Spin', 'brand_id' => 2],
            ['model' => 'Yaris Sedan', 'brand_id' => 8],
        ];

        foreach ($models as $model) {
            \App\Models\VehicleModel::create($model);
        }
    }
}
