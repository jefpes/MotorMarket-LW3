<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employees>
 */
class EmployeeFactory extends Factory
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
            'email'          => fake()->unique()->safeEmail(),
            'salary'         => $this->faker->randomFloat(2, 1000, 10000),
            'rg'             => $this->faker->unique()->numerify('##.###.###-#'),
            'cpf'            => $this->faker->unique()->numerify('###.###.###-##'),
            'marital_status' => $this->faker->randomElement(['Solteiro', 'Casado', 'Divorciado', 'Viúvo']),
            'phone_one'      => $this->faker->unique()->numerify('(##) #####-####'),
            'phone_two'      => $this->faker->optional()->numerify('(##) #####-####'),
            'birth_date'     => $this->faker->date(),
            'father'         => $this->faker->optional()->name('male'),
            'mother'         => $this->faker->name('female'),
            'marital_status' => $this->faker->randomElement(['Solteiro', 'Casado', 'Divorciado', 'Viúvo']),
            'spouse'         => $this->faker->optional()->name,
        ];
    }
}
