<?php

namespace Database\Seeders;

use App\Models\{Employee};
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $photo = 'employee_' . ($i + 1) . '.webp';
            Employee::factory()->withAddress()->create()->photos()->create([
                'photo_name' => $photo,
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/client_photos/' . $photo,
                'path'       => 'storage/employee_photos/' . $photo,
            ]);
        }
    }
}
