<?php

namespace Database\Seeders;

use App\Models\{Client};
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++) {
            $photo = 'client_' . ($i + 1) . '.webp';
            Client::factory()->withAddress()->create()->photos()->create([
                'photo_name' => $photo,
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/' . $photo,
                'path'       => 'storage/client_photos/' . $photo,
            ]);
        }
    }
}
