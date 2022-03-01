<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_received_product_json_data(): void
    {
        $response = $this->getJson('api/v1/product');

        $response->assertJsonStructure([
            'data' => [
                    'type',
                    'attributes' => [
                        'product_name' ,
                        'price' ,
                        'picture' ,
                        'description'
                    ]
                ]
        ]);
    }
}
