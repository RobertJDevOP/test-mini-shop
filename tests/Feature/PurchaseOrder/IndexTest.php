<?php

namespace Tests\Feature\PurchaseOrder;

use App\Models\Customer;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_received_purchase_order_json_data(): void
    {
        $this->createPurchaseOrder();

        $response = $this->getJson('api/v1/purchases');

        $response->assertJsonStructure([
            '*' => [
                    'id',
                    'details_order'
            ]
        ]);
    }

    public function createPurchaseOrder(): Model
    {
        Customer::factory()->create();

        return PurchaseOrder::factory()
            ->has(PurchaseOrderDetail::factory()->count(1), 'detailsOrder')
            ->create();
    }
}
