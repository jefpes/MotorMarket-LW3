<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Fiat',
            'Volkswagen',
            'Chevrolet',
            'Hyundai',
            'Toyota',
            'Jeep',
            'Renault',
            'Honda',
            'Nissan',
            'Ford',
            'Caoa Chery',
            'Peugeot',
            'Citroën',
            'Mitsubishi',
            'BMW',
            'Mercedes-Benz',
            'Volvo',
            'Audi',
            'Kia',
            'Land Rover',
        ];

        foreach ($brands as $brand) {
            \App\Models\Brand::create(['name' => $brand]);
        }
    }
}
