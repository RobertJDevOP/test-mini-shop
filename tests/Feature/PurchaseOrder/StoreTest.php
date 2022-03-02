<?php

namespace Tests\Feature\PurchaseOrder;

use App\Models\DocumentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_generate_purchase_order(): void
    {
        $response = $this->post('api/v1/createOrder/' , $this->makePurchaseOrder());

        $response->assertSessionHasNoErrors();
        $this->followRedirects($response)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status' => [
                    'status'
                ]
            ]);
    }

    public function makePurchaseOrder(): array
    {
        $documentType = DocumentType::factory()->create();

        return [
                'customerDocumentNumber' => 1234567890,
                'customerStreet' => 'FLORIDABLANCA SANTANDER',
                'customerDocumentType' => $documentType->id,
                'customerName' => 'ROBERTO JIMENEZ',
                'customerEmail' => 'rcjimenetest@gmail.com',
                'customerPhone' => '3119292992',
                'qtyProduct' => 1
        ];
    }
}


