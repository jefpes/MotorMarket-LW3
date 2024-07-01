<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employees>
 */
class EmployeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'           => $this->faker->name,
            'email'          => $this->faker->unique()->safeEmail,
            'phone_one'      => $this->faker->phoneNumber,
            'phone_two'      => $this->faker->optional()->phoneNumber,
            'salary'         => $this->faker->randomFloat(2, 1000, 10000),
            'rg'             => $this->faker->unique()->numerify('########-#'),
            'cpf'            => $this->faker->unique()->numerify('###.###.###-##'),
            'birth_date'     => $this->faker->date(),
            'father'         => $this->faker->optional()->name,
            'mother'         => $this->faker,
            'marital_status' => $this->faker->randomElement(['Solteiro', 'Casado', 'Divorciado', 'Viúvo']),
            'spouse'         => $this->faker->optional()->name,
        ];
    }
}
