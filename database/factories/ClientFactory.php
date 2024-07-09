<?php

namespace Database\Factories;

use App\Enums\{MaritalStatus};
use App\Models\{Client, ClientAddress};
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
            'name'           => $this->faker->name,
            'rg'             => $this->faker->unique()->numerify('##.###.###-#'),
            'cpf'            => $this->faker->unique()->numerify('###.###.###-##'),
            'marital_status' => $this->faker->randomElement(array_map(fn ($case) => $case->value, MaritalStatus::cases())),
            'phone_one'      => $this->faker->unique()->numerify('(##) #####-####'),
            'phone_two'      => $this->faker->optional()->numerify('(##) #####-####'),
            'birth_date'     => $this->faker->date(),
            'father'         => $this->faker->optional()->name('male'),
            'mother'         => $this->faker->name('female'),
            'affiliated_one' => $this->faker->name,
            'affiliated_two' => $this->faker->name,
            'description'    => $this->faker->text,
        ];
    }

    public function withAddress()
    {
        return $this->afterCreating(function (Client $client) {
            ClientAddress::factory()->create(['client_id' => $client->id]);
        });
    }
}
