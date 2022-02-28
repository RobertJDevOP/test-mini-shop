<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::Factory()->create(),
            'qty' => 1,
            'customer_name' => 'Roberto Jimenez',
            'customer_email' => 'rcjimenez35@gmail.com',
            'customer_mobile' => 3117119157,
            'status' => 'CREATED',
            'total' => 3000000
        ];
    }
}
