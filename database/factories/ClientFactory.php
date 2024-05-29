<?php

namespace Database\Factories;

use App\Enums\{LogradouroType, States};
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
            'name'            => $this->faker->name,
            'rg'              => $this->faker->unique()->numerify('##.###.###-#'),
            'cpf'             => $this->faker->unique()->numerify('###.###.###-##'),
            'phone_one'       => $this->faker->unique()->numerify('(##) #####-####'),
            'phone_two'       => $this->faker->optional()->numerify('(##) #####-####'),
            'birth_date'      => $this->faker->date(),
            'father'          => $this->faker->optional()->name('male'),
            'mother'          => $this->faker->name('female'),
            'affiliated_one'  => $this->faker->name,
            'affiliated_two'  => $this->faker->name,
            'description'     => $this->faker->text,
            'cep'             => $this->faker->numerify('#####-###'),
            'logradouro_type' => $this->faker->randomElement(LogradouroType::cases()),
            'logradouro'      => $this->faker->streetName,
            'number'          => $this->faker->buildingNumber,
            'complement'      => $this->faker->optional()->secondaryAddress,
            'bairro'          => $this->faker->citySuffix,
            'city_id'         => $this->faker->randomNumber(1, 10),
            'state'           => $this->faker->randomElement(States::cases()),
            'country'         => 'Brasil',
        ];
    }
}
