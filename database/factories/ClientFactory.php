<?php

namespace Database\Factories;

use App\Enums\LogradouroType;
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
            'description'      => $this->faker->text,
            'cep'              => $this->faker->numerify('#####-###'),
            'type'             => $this->faker->randomElement(LogradouroType::cases()),
            'logradouro'       => $this->faker->streetName,
            'number'           => $this->faker->buildingNumber,
            'complement'       => $this->faker->optional()->secondaryAddress,
            'bairro'           => $this->faker->citySuffix,
            'city'             => $this->faker->city,
            'state'            => $this->faker->stateAbbr,
            'country'          => 'Brasil',
        ];
    }
}
