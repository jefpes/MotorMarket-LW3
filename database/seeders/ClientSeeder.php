<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory()->create()->photos()->create([
            'photo_name' => 'client_1.webp',
            'format'     => 'webp',
            'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/client_1.webp',
            'path'       => 'storage/client_photos/client_1.webp',
        ]);

        Client::factory()->create()->photos()->create([
            'photo_name' => 'client_2.webp',
            'format'     => 'webp',
            'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/client_2.webp',
            'path'       => 'storage/client_photos/client_2.webp',
        ]);

        Client::factory()->create()->photos()->create([
            'photo_name' => 'client_3.webp',
            'format'     => 'webp',
            'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/client_3.webp',
            'path'       => 'storage/client_photos/client_3.webp',
        ]);

        Client::factory()->create()->photos()->create([
            'photo_name' => 'client_4.webp',
            'format'     => 'webp',
            'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/client_4.webp',
            'path'       => 'storage/client_photos/client_4.webp',
        ]);

        Client::factory()->create()->photos()->create([
            'photo_name' => 'client_5.webp',
            'format'     => 'webp',
            'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/client_5.webp',
            'path'       => 'storage/client_photos/client_5.webp',
        ]);

        Client::factory()->create()->photos()->create([
            'photo_name' => 'client_6.webp',
            'format'     => 'webp',
            'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/client_6.webp',
            'path'       => 'storage/client_photos/client_6.webp',
        ]);

        Client::factory()->create()->photos()->create([
            'photo_name' => 'client_7.webp',
            'format'     => 'webp',
            'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/client_7.webp',
            'path'       => 'storage/client_photos/client_7.webp',
        ]);

        Client::factory()->create()->photos()->create([
            'photo_name' => 'client_8.webp',
            'format'     => 'webp',
            'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/client_8.webp',
            'path'       => 'storage/client_photos/client_8.webp',
        ]);

        Client::factory()->create()->photos()->create([
            'photo_name' => 'client_9.webp',
            'format'     => 'webp',
            'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/client_9.webp',
            'path'       => 'storage/client_photos/client_9.webp',
        ]);

        Client::factory()->create()->photos()->create([
            'photo_name' => 'client_10.webp',
            'format'     => 'webp',
            'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/client_10.webp',
            'path'       => 'storage/client_photos/client_10.webp',
        ]);
    }
}
