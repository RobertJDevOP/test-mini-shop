<?php

namespace Database\Factories;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{

    public function definition(): array
    {
        return [
            'document_number' => $this->faker->unique()->randomDigit(10),
            'address' => $this->faker->address(),
            'document_type_id' =>DocumentType::Factory()->create(),
        ];
    }

}
