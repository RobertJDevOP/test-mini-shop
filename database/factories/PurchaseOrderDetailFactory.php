<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'purchase_order_id' => $this->faker->randomElement(PurchaseOrder::all())['id'],
            'product_id' => 4711081355274,
            'qty' => 1,
            'price' => 1 * 3000000,
        ];
    }
}
