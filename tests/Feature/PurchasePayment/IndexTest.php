<?php

namespace Tests\Feature\PurchasePayment;

use App\Models\Customer;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\PaymentGateways\PlacetopayWebCheckout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_placetopay_create_request_received_json_structure(): void
    {
        $purchaseOrder = $this->createPurchaseOrder();

        $response = $this->getJson('/checkout/'.$purchaseOrder->id);

        $response->assertStatus(Response::HTTP_OK);
        $response
            ->assertJsonStructure([
                    'status' => [
                        'status',
                        'reason',
                        'message',
                    ],
                    'requestId',
                    'processUrl',
                    'purchaseOrderId'
                ]
            );
    }

    public function test_it_placetopay_request_info_received_json_structure(): void
    {
        $purchaseOrder = $this->createPurchaseOrder();
        $paymentGateway = new PlacetopayWebCheckout($purchaseOrder,null);
        $paymentGateway->createRequest();

        $response = $this->get('/payment/'.$purchaseOrder->id);

        $response->assertStatus(Response::HTTP_OK);
        $response
            ->assertJsonStructure([
                    'requestId',
                    'status' => [
                        'status',
                        'reason',
                        'message',
                        'date'
                    ],
                ]
            );
    }

    public function test_it_can_continue_payment(): void
    {
        $placeToPayResponse = $this->placetopayResponse();
        $purchaseOrder = $this->createPurchaseOrder();
        Http::fake([
            'https://checkout-co.placetopay.dev/api/session/123123' => Http::response($placeToPayResponse,200)
        ]);
        $paymentWallet = new PlacetopayWebCheckout($purchaseOrder->id,$placeToPayResponse['requestId']);
        $paymentWallet->getRequestInformation();

        $response = $this->getJson('/continuePayment/'.$purchaseOrder->id);

        $response->assertStatus(Response::HTTP_OK);
        $response
            ->assertJson(fn (AssertableJson $json) =>
            $json->where('processUrl', $placeToPayResponse['processUrl'])
            );
    }

    public function createPurchaseOrder(): Model
    {
        Customer::factory()->create();

        return PurchaseOrder::factory()
            ->has(PurchaseOrderDetail::factory()->count(1), 'detailsOrder')
            ->create();
    }

    public function placetopayResponse(): array
    {
        return [
            'status' => [
                'status'=> 'OK',
                'reason'=> 'PC',
                'message'=> 'La petición se ha procesado correctamente',
                'date'=> '2021-11-30T15:08:27-05:00',
            ],
            'requestId'=> 123123,
            'processUrl'=> 'https://checkout-co.placetopay.com/session/1/cc9b8690b1f7228c78b759ce27d7e80a',
        ];
    }

}
