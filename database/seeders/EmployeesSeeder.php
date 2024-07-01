<?php

namespace Database\Seeders;

use App\Models\Employees;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = Employees::factory()->count(1)->create();

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
            'city'         => 'City',
            'state'        => 'CE',
            'country'      => 'Brasil',
            'complement'   => 'Complement',
            'main'         => true,
        ]);
    }
}
