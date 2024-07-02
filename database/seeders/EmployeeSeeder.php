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
        $employee = Employee::factory()->create();

        $employee->photos()->create([
            'photo_name' => 'photo',
            'format'     => 'jpg',
            'full_path'  => 'path/to/photo',
            'path'       => 'path',
        ]);

        $employee->address()->create([
            'zip_code'     => '00000-000',
            'street'       => 'Street',
            'number'       => '123',
            'neighborhood' => 'Neighborhood',
            'city_id'      => 1,
            'state'        => 'CE',
            'complement'   => 'Complement',
        ]);
    }
}
