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
            ['name' => 'Argo', 'brand_id' => 1],
            ['name' => 'Toro', 'brand_id' => 1],
            ['name' => 'Cronos', 'brand_id' => 1],
            ['name' => 'Mobi', 'brand_id' => 1],
            ['name' => 'Onix', 'brand_id' => 2],
            ['name' => 'Corsa', 'brand_id' => 2],
            ['name' => 'Onix Plus', 'brand_id' => 2],
            ['name' => 'Montana', 'brand_id' => 2],
            ['name' => 'S10', 'brand_id' => 2],
            ['name' => 'HB20', 'brand_id' => 3],
            ['name' => 'HB20S', 'brand_id' => 3],
            ['name' => 'Polo', 'brand_id' => 4],
            ['name' => 'Gol', 'brand_id' => 4],
            ['name' => 'Virtus', 'brand_id' => 4],
            ['name' => 'Saveiro', 'brand_id' => 4],
            ['name' => 'Renegade', 'brand_id' => 5],
            ['name' => 'City', 'brand_id' => 6],
            ['name' => 'HR-V', 'brand_id' => 6],
            ['name' => 'Oroch', 'brand_id' => 7],
            ['name' => 'Kwid', 'brand_id' => 7],
            ['name' => 'Duster', 'brand_id' => 7],
            ['name' => 'Corolla Cross', 'brand_id' => 8],
            ['name' => 'Corolla', 'brand_id' => 8],
            ['name' => 'Hilux', 'brand_id' => 8],
            ['name' => 'Yaris', 'brand_id' => 8],
            ['name' => 'Hilux SW4', 'brand_id' => 8],
            ['name' => 'Yaris Sedan', 'brand_id' => 8],
            ['name' => 'Kicks', 'brand_id' => 9],
            ['name' => 'Ranger', 'brand_id' => 10],
            ['name' => 'Bros', 'brand_id' => 6],
            ['name' => 'Titan', 'brand_id' => 6],
            ['name' => 'Crosser', 'brand_id' => 11],
            ['name' => 'Lander', 'brand_id' => 11],
            ['name' => 'Celta', 'brand_id' => 2],
            ['name' => 'Twister', 'brand_id' => 6],
            ['name' => 'XRE 190', 'brand_id' => 6],

        ];

        foreach ($models as $model) {
            \App\Models\VehicleModel::create($model);
        }
    }
}
