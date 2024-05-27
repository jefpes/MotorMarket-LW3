<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'             => $this->faker->name,
            'rg'               => $this->faker->unique()->numerify('##########'),
            'cpf'              => $this->faker->unique()->numerify('###.###.###-##'),
            'phone_one'        => $this->faker->unique()->numerify('(##) #####-####'),
            'phone_two'        => $this->faker->optional()->numerify('(##) #####-####'),
            'birth_date'       => $this->faker->date(),
            'affiliated_one'   => $this->faker->name,
            'affiliated_two'   => $this->faker->name,
            'affiliated_three' => $this->faker->name,
            'cep'              => $this->faker->numerify('#####-###'),
            'logradouro'       => $this->faker->streetName,
            'numero'           => $this->faker->buildingNumber,
            'complemento'      => $this->faker->optional()->secondaryAddress,
            'bairro'           => $this->faker->citySuffix,
            'cidade'           => $this->faker->city,
            'estado'           => $this->faker->stateAbbr,
            'pais'             => 'Brasil',
        ];
    }
}
