<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['CC','TI','CE','NIT','RUT']),
            'description' => $this->faker->sentence(1),
        ];
    }
}
